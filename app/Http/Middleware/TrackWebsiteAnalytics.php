<?php

namespace App\Http\Middleware;

use App\Models\WebsitePageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackWebsiteAnalytics
{
    /**
     * Process the request and record eligible public page views.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Let Laravel handle the request normally first.
        $response = $next($request);

        // Track only successful, normal GET page requests.
        if (!$this->shouldTrack($request, $response)) {
            return $response;
        }

        $userAgent = (string) $request->userAgent();

        // Exclude common automated crawlers.
        if ($this->isBot($userAgent)) {
            return $response;
        }

        try {
            $visitorId = $this->getVisitorId($request);

            $sessionId = $request->hasSession()
                ? $request->session()->getId()
                : null;

            $referrer = $request->headers->get('referer');

            $referrerHost = $this->getReferrerHost($referrer);

            $trafficSource = $this->getTrafficSource(
                $referrerHost,
                $request->getHost()
            );

            WebsitePageView::create([
                'visitor_id' => $visitorId,
                'session_id' => $sessionId,
                'path' => '/' . ltrim($request->path(), '/'),
                'referrer' => $referrer
                    ? Str::limit($referrer, 2048, '')
                    : null,
                'traffic_source' => $trafficSource,
                'device_type' => $this->getDeviceType($userAgent),
                'viewed_at' => now(),
            ]);

            // Set an anonymous visitor cookie for one year.
            $response->headers->setCookie(
                cookie(
                    'ees_visitor_id',
                    $visitorId,
                    60 * 24 * 365,
                    '/',
                    null,
                    $request->isSecure(),
                    true,
                    false,
                    'lax'
                )
            );
        } catch (Throwable $exception) {
            // Analytics failures should not break public page delivery.
            Log::warning('Website analytics tracking failed.', [
                'exception' => $exception::class,
            ]);
        }

        return $response;
    }

    /**
     * Determine whether this request should be recorded.
     */
    private function shouldTrack(
        Request $request,
        Response $response
    ): bool {
        if (
            !$request->isMethod('GET') ||
            !$response->isSuccessful() ||
            $request->expectsJson()
        ) {
            return false;
        }

        $excludedPaths = [
            'admin',
            'admin/*',
            'login',
            'logout',
            'up',
            'storage/*',
            'build/*',
            'assets/*',
            'css/*',
            'js/*',
            'images/*',
            'fonts/*',
            'favicon.ico',
            'robots.txt',
        ];

        foreach ($excludedPaths as $path) {
            if ($request->is($path)) {
                return false;
            }
        }

        // Do not count authenticated admin users browsing the public site.
        if (
            $request->user() &&
            $request->user()->hasAnyRole([
                'Super Admin',
                'Administrator',
            ])
        ) {
            return false;
        }

        return true;
    }

    /**
     * Exclude common bot and preview user agents.
     */
    private function isBot(string $userAgent): bool
    {
        if ($userAgent === '') {
            return false;
        }

        return preg_match(
            '/bot|crawler|spider|slurp|preview|headless/i',
            $userAgent
        ) === 1;
    }

    /**
     * Retrieve or generate an anonymous visitor identifier.
     */
    private function getVisitorId(Request $request): string
    {
        $visitorId = $request->cookie('ees_visitor_id');

        if (
            is_string($visitorId) &&
            preg_match('/^[a-f0-9-]{36}$/i', $visitorId) === 1
        ) {
            return $visitorId;
        }

        return (string) Str::uuid();
    }

    /**
     * Extract the hostname from a referrer URL.
     */
    private function getReferrerHost(?string $referrer): ?string
    {
        if (!$referrer) {
            return null;
        }

        $host = parse_url($referrer, PHP_URL_HOST);

        return is_string($host) ? $host : null;
    }

    /**
     * Classify the source of the visit.
     */
    private function getTrafficSource(
        ?string $referrerHost,
        string $currentHost
    ): string {
        if (!$referrerHost) {
            return 'direct';
        }

        if (strcasecmp($referrerHost, $currentHost) === 0) {
            return 'internal';
        }

        if (preg_match(
            '/google\.|bing\.|yahoo\.|duckduckgo\./i',
            $referrerHost
        ) === 1) {
            return 'search';
        }

        if (preg_match(
            '/facebook\.|instagram\.|linkedin\.|tiktok\.|x\.com$|twitter\./i',
            $referrerHost
        ) === 1) {
            return 'social';
        }

        return 'referral';
    }

    /**
     * Classify the visitor's device using its user agent.
     */
    private function getDeviceType(string $userAgent): string
    {
        if ($userAgent === '') {
            return 'unknown';
        }

        if (preg_match('/ipad|tablet/i', $userAgent) === 1) {
            return 'tablet';
        }

        if (preg_match('/mobile|iphone|android/i', $userAgent) === 1) {
            return 'mobile';
        }

        return 'desktop';
    }
}

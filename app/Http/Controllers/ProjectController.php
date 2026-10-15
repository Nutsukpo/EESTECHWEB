<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display projects in the admin dashboard.
     */
    public function index(): View
    {
        $projects = Project::query()
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the project registration form.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Store a new project.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProject($request);

        $data['slug'] = $this->generateUniqueSlug($data['title']);

        $data['technologies'] = $this->parseTechnologies(
            $data['technologies'] ?? null
        );

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        $data['published_at'] = $data['is_published']
            ? now()
            : null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('projects', 'public');
        }

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display a project in the admin area.
     */
    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the project editing form.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update an existing project.
     */
    public function update(
        Request $request,
        Project $project
    ): RedirectResponse {
        $data = $this->validateProject($request, $project);

        $data['slug'] = $this->generateUniqueSlug(
            $data['title'],
            $project->id
        );

        $data['technologies'] = $this->parseTechnologies(
            $data['technologies'] ?? null
        );

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published']) {
            $data['published_at'] = $project->published_at ?? now();
        } else {
            $data['published_at'] = null;
        }

        $oldImage = $project->cover_image;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('projects', 'public');
        }

        $project->update($data);

        // Remove the old image only after the database update succeeds.
        if (
            $request->hasFile('cover_image') &&
            $oldImage &&
            $oldImage !== $project->cover_image
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Publish or unpublish a project.
     */
    public function togglePublication(
        Project $project
    ): RedirectResponse {
        if ($project->is_published) {
            $project->update([
                'is_published' => false,
                'published_at' => null,
            ]);

            $message = 'Project unpublished successfully.';
        } else {
            $project->update([
                'is_published' => true,
                'published_at' => now(),
            ]);

            $message = 'Project published successfully.';
        }

        return back()->with('success', $message);
    }

    /**
     * Soft-delete a project.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project moved to the recycle bin.');
    }

    /**
     * Validate project form data.
     */
    private function validateProject(
        Request $request,
        ?Project $project = null
    ): array {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'nullable',
                'string',
                'max:150',
            ],

            'client_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'challenge' => [
                'nullable',
                'string',
            ],

            'solution' => [
                'nullable',
                'string',
            ],

            'results' => [
                'nullable',
                'string',
            ],

            'technologies' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'project_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'is_featured' => [
                'sometimes',
                'boolean',
            ],

            'is_published' => [
                'sometimes',
                'boolean',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
                'max:1000000',
            ],
        ]);
    }

    /**
     * Generate a unique slug from the project title.
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($title);

        if ($baseSlug === '') {
            $baseSlug = 'project';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Project::withTrashed()
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Convert comma-separated technologies into an array.
     */
    private function parseTechnologies(?string $technologies): array
    {
        if (!$technologies) {
            return [];
        }

        return collect(explode(',', $technologies))
            ->map(fn ($technology) => trim($technology))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}

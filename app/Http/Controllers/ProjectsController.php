<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    /**
     * Display published projects.
     */
    public function index(): View
    {
        $projects = Project::published()
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('public.projects.index', compact('projects'));
    }

    /**
     * Display a single published project.
     */
    public function show(Project $project): View
    {
        abort_unless(
            $project->is_published
            && $project->published_at
            && $project->published_at->lte(now()),
            404
        );

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->when(
                $project->category,
                fn ($query) => $query->where('category', $project->category)
            )
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->limit(3)
            ->get();

        return view('public.projects.show', compact(
            'project',
            'relatedProjects'
        ));
    }
}

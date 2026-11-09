<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * GET /api/projects
     * Query opsional: ?q=kata (cari judul/deskripsi), ?tech=Laravel, ?per_page=10 (maks 50)
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'q' => 'nullable|string|max:100',
            'tech' => 'nullable|string|max:50',
            'per_page' => 'nullable|integer|min:1|max:50',
        ]);

        $projects = Project::query()
            ->when($data['q'] ?? null, fn ($query, $q) => $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
            }))
            ->when($data['tech'] ?? null, fn ($query, $tech) => $query->where('tech_stack', 'like', "%{$tech}%"))
            ->latest()
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return ProjectResource::collection($projects);
    }

    /** GET /api/projects/{id} */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }
}

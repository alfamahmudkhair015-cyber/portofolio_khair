<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'tech_stack' => array_map('trim', explode(',', $this->tech_stack)),
            'demo_url' => $this->demo_url,
            'github_url' => $this->github_url,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}

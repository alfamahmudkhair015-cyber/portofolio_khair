<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_daftar_project_berformat_json_dan_terpaginasi(): void
    {
        Project::factory()->count(3)->create();

        $this->getJson('/api/projects')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [['id', 'title', 'description', 'tech_stack', 'demo_url', 'github_url', 'created_at']],
                'links', 'meta',
            ]);
    }

    public function test_tech_stack_dikembalikan_sebagai_array(): void
    {
        Project::factory()->create(['tech_stack' => 'Laravel, MySQL']);

        $this->getJson('/api/projects')->assertJsonPath('data.0.tech_stack', ['Laravel', 'MySQL']);
    }

    public function test_filter_pencarian_dan_teknologi(): void
    {
        Project::factory()->create(['title' => 'Aplikasi Kasir', 'tech_stack' => 'Flutter']);
        Project::factory()->create(['title' => 'Website Wisata', 'tech_stack' => 'Laravel']);

        $this->getJson('/api/projects?q=Kasir')->assertJsonCount(1, 'data')->assertJsonPath('data.0.title', 'Aplikasi Kasir');
        $this->getJson('/api/projects?tech=Laravel')->assertJsonCount(1, 'data')->assertJsonPath('data.0.title', 'Website Wisata');
    }

    public function test_per_page_melebihi_batas_ditolak(): void
    {
        $this->getJson('/api/projects?per_page=1000')->assertStatus(422);
    }

    public function test_detail_project_dan_404(): void
    {
        $project = Project::factory()->create();

        $this->getJson("/api/projects/{$project->id}")->assertOk()->assertJsonPath('data.id', $project->id);
        $this->getJson('/api/projects/9999')->assertNotFound();
    }

    public function test_kirim_pesan_kontak_lewat_api(): void
    {
        $this->postJson('/api/contact-messages', [
            'name' => 'Sari',
            'email' => 'sari@example.com',
            'message' => 'Halo!',
        ])->assertCreated()->assertJsonMissing(['email' => 'sari@example.com']);

        $this->assertDatabaseHas('contact_messages', ['email' => 'sari@example.com']);
    }

    public function test_pesan_kontak_tidak_valid_mengembalikan_422(): void
    {
        $this->postJson('/api/contact-messages', ['email' => 'salah'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_pesan_kontak_dibatasi_rate_limit(): void
    {
        $payload = ['name' => 'A', 'email' => 'a@example.com', 'message' => 'Hi'];

        for ($i = 0; $i < 10; $i++) {
            $this->postJson('/api/contact-messages', $payload)->assertCreated();
        }

        $this->postJson('/api/contact-messages', $payload)->assertStatus(429);
    }
}

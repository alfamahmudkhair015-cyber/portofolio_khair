<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_dasar_bisa_dibuka(): void
    {
        foreach (['/', '/about', '/projects', '/contact'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_halaman_projects_menampilkan_data_dari_database(): void
    {
        $this->seed();

        $this->get('/projects')->assertOk()->assertSee('Website Wisata Lombok Timur');
    }

    public function test_detail_project_dan_404(): void
    {
        $project = Project::create([
            'title' => 'Proyek Uji',
            'description' => 'Deskripsi uji',
            'tech_stack' => 'Laravel',
        ]);

        $this->get("/projects/{$project->id}")->assertOk()->assertSee('Proyek Uji');
        $this->get('/projects/9999')->assertNotFound();
    }

    public function test_form_kontak_menyimpan_pesan_ke_database(): void
    {
        $this->post('/contact', [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'message' => 'Halo, tertarik bekerja sama.',
        ])->assertRedirect(route('contact'))->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', ['email' => 'budi@example.com']);
        $this->assertSame(1, ContactMessage::count());
    }

    public function test_form_kontak_menolak_data_tidak_valid(): void
    {
        $this->post('/contact', ['name' => '', 'email' => 'bukan-email', 'message' => ''])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }
}

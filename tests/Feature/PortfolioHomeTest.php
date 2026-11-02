<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioHomeTest extends TestCase
{
    public function test_portfolio_homepage_renders_all_primary_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('I Build')
            ->assertSee('Fast, Modern &')
            ->assertSee('Scalable Web Apps')
            ->assertSee('Saya Alfa Mahmud Khair, mahasiswa semester 4')
            ->assertSee('Universitas Teknokrat Indonesia')
            ->assertSee('Projects Completed')
            ->assertSee('Flutter')
            ->assertSee('My Journey')
            ->assertSee('Indonesia')
            ->assertSee('ARUNIKA')
            ->assertSee('KASIRKU')
            ->assertSee('DIGITAL PLAYGROUND')
            ->assertSee('href="#home"', false)
            ->assertSee('href="#projects"', false)
            ->assertSee('href="#contact"', false)
            ->assertSee('id="home"', false)
            ->assertSee('id="about"', false)
            ->assertSee('id="projects"', false)
            ->assertSee('id="skills"', false)
            ->assertSee('id="experience"', false)
            ->assertSee('id="contact"', false)
            ->assertSee('alfamahmudkhair@teknokrat.ac.id')
            ->assertSee('https://github.com/alfamahmudkhair015-cyber')
            ->assertSee('https://www.instagram.com/alfa_alkhairi')
            ->assertSee('images/foto.jpg');
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioHomeTest extends TestCase
{
    public function test_portfolio_homepage_renders_all_primary_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('<span>CURIOUS BY</span>', false)
            ->assertSee('<span>NATURE.</span>', false)
            ->assertSee('<em>BUILT THROUGH</em>', false)
            ->assertSee('<em>CODE.</em>', false)
            ->assertSee('Informatics student at')
            ->assertSee('Universitas Teknokrat Indonesia')
            ->assertSee('mahasiswa semester 4')
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

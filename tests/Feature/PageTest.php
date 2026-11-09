<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageTest extends TestCase
{
    public function test_halaman_dasar_bisa_dibuka(): void
    {
        foreach (['/', '/about', '/contact'] as $url) {
            $this->get($url)->assertOk();
        }
    }
}

<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Teams;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Teams::class);

        $component->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\TeamConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TeamConfigTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TeamConfig::class);

        $component->assertStatus(200);
    }
}

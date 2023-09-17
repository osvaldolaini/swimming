<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CoachTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CoachTeamTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(CoachTeam::class);

        $component->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Livewire\Admin;

use App\Http\Livewire\Admin\AdminConfigTeams;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminConfigTeamsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(AdminConfigTeams::class);

        $component->assertStatus(200);
    }
}

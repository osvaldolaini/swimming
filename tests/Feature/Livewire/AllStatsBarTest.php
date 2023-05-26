<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\AllStatsBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllStatsBarTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(AllStatsBar::class);

        $component->assertStatus(200);
    }
}

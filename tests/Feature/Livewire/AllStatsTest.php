<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\AllStats;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllStatsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(AllStats::class);

        $component->assertStatus(200);
    }
}

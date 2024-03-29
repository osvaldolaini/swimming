<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Coachs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CoachsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Coachs::class);

        $component->assertStatus(200);
    }
}

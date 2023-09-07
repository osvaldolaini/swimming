<?php

namespace Tests\Feature\Livewire\Team;

use App\Http\Livewire\Team\Absoluto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AbsolutoTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Absoluto::class);

        $component->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Relay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RelayTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Relay::class);

        $component->assertStatus(200);
    }
}

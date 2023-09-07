<?php

namespace Tests\Feature\Livewire\Team;

use App\Http\Livewire\Team\Base;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BaseTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Base::class);

        $component->assertStatus(200);
    }
}

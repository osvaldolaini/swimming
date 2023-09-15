<?php

namespace Tests\Feature\Livewire\Admin;

use App\Http\Livewire\Admin\AdminRelays;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminRelaysTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(AdminRelays::class);

        $component->assertStatus(200);
    }
}

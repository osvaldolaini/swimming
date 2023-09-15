<?php

namespace Tests\Feature\Livewire\Admin;

use App\Http\Livewire\Admin\AdminAllAthletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminAllAthletesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(AdminAllAthletes::class);

        $component->assertStatus(200);
    }
}

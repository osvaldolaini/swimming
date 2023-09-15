<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\GroupUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GroupUserTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(GroupUser::class);

        $component->assertStatus(200);
    }
}

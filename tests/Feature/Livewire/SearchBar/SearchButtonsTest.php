<?php

namespace Tests\Feature\Livewire\SearchBar;

use App\Http\Livewire\SearchBar\SearchButtons;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchButtonsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SearchButtons::class);

        $component->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\SheetsImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SheetsImportTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SheetsImport::class);

        $component->assertStatus(200);
    }
}

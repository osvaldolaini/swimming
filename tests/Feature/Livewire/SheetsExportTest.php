<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\SheetsExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SheetsExportTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SheetsExport::class);

        $component->assertStatus(200);
    }
}

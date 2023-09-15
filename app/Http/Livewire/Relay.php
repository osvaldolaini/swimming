<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use App\Models\Model\Relays;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Relay extends Component
{
    use WithPagination;

    public Relays $relays;
    public $search;
    public $sortField = 'birth_year_end';
    public $sortDirection = 'asc';
    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $registerId;
    public $alertSession = false;
    public $selectFilter = 'name';
    public $type = '1';



    public $getStat;
    public bool $toggleStatus;

    public $detail;
    public $categories;
    public $active = 1;
    public $name;
    public $code;
    public $old_min;
    public $old_max;
    public $min_age;
    public $max_age;
    public $rules;
    public $heads;
    public $model_id;
    public $category_id;
    public $initial;
    public $final;

    protected $listeners =
    [
        'showModalCreate',
        'showModalRead',
        'showModalUpdate',
        'showModalDelete'
    ];
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
    }
    public function changeType()
    {
        $cat = Categories::find($this->category_id);
        $this->type = $cat->convertType;
        $this->min_age = $cat->min_age;
        $this->max_age = $cat->max_age;
        $this->initial = $cat->min_age;
        $this->final   = $cat->max_age + 1;
    }

    public function render()
    {
        return view('livewire.relay');
    }
}

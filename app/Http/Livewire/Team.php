<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use App\Models\Model\Teams;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Team extends Component
{
    use WithPagination;

    public Teams $Teams;
    public $search;
    public $sortField = 'birth_year_end';
    public $sortDirection = 'asc';
    public $showJetModal= false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $registerId;
    public $alertSession = false;
    public $selectFilter = 'name';


    public $getStat;
    public bool $toggleStatus;

    public $detail;
    public $categories = '';
    public $active = 1;
    public $name;
    public $type;
    public $code;
    public $min_age;
    public $max_age;
    public $category_id = '';
    public $rules;
    public $heads;
    public $model_id;
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
    public function openAlert($status,$msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
    }

    public function render()
    {
        return view('livewire.team');
    }
}

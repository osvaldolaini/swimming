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
        $this->categories = Categories::orderBy('id','asc')
        ->get();
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
        return view('livewire.team');
    }
    //CREATE
    public function showModalCreate()
    {
        $this->reset('name',
                    'max_age',
                    'min_age',
                    'type',
                    'category_id',
                    );
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
                'name'  =>'required|min:4|max:255',
                'category_id'=>'required',
        ];

        $this->validate();

        Teams::create([
            'name'          =>ucwords(mb_strtolower($this->name)),
            'min_age'       =>$this->min_age,
            'max_age'       =>$this->max_age,
            'active'        =>$this->active,
            'category_id'   =>$this->category_id,
            'type'          =>$this->type,
            'code'          =>Str::uuid(),
            'created_by'    =>Auth::user()->name,
        ]);
            $this->openAlert('success','Registro criado com sucesso.');

            $this->alertSession = true;
            $this->showModalCreate = false;
            $this->reset('name',
                         'max_age',
                         'type',
                         'category_id',
                        );
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView= true;

        if (isset($id)) {
            $data = Teams::where('id',$id)->first();
            // dd($data);
            $this->detail = [
                'Categoria'         => ucwords(mb_strtolower($data->name)),
                'Status'            => ($data->active == 1 ? 'Ativo':'Inativo'),
                'Criada'            => convertDate($data->created_at),
                'Criada por'        => $data->created_by,
                'Atualizada'        => convertDate($data->updated_at),
                'Atualizada por'    => $data->updated_by,
            ];
        }else{
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalUpdate(Teams $teams)
    {
        $this->model_id         = $teams->id;
        $this->name             = $teams->name;
        $this->min_age          = $teams->min_age;
        $this->max_age          = $teams->max_age;
        $this->initial          = $teams->min_age;
        $this->final            = $teams->max_age + 1;
        $this->category_id      = $teams->category_id;
        $this->active           = $teams->active;
        $this->showModalEdit    = true;
    }
    public function update()
    {
        $this->rules = [
            'name'  =>'required|min:4|max:255',
            'category_id'=>'required',
    ];
               $this->validate();

        Teams::updateOrCreate([
            'id'=>$this->model_id,
        ],[
            'name'          =>ucwords(mb_strtolower($this->name)),
            'min_age'       =>$this->min_age,
            'max_age'       =>$this->max_age,
            'active'        =>$this->active,
            'category_id'   =>$this->category_id,
            'type'          =>$this->type,
            'active'        =>$this->active,
            'updated_by'    =>Auth::user()->name,
        ]);

        $this->openAlert('success','Registro atualizado com sucesso.');

            $this->alertSession = true;
            $this->showModalEdit = false;
            $this->reset('name',
                         'max_age',
                         'min_age',
                         'type',
                         'category_id',
                        );
    }
    //DELETE
    public function showModalDelete($id)
    {
        $this->showJetModal= true;
        if (isset($id)) {
            $this->registerId = $id;
        }else{
            $this->registerId = '';
        }
    }
    public function delete($id)
    {
        $data = Teams::where('id',$id)->first();
        $data->active = '0';
        $data->save();
        $this->openAlert('success','Registro excluido com sucesso.');

            $this->alertSession = true;
            $this->showJetModal = false;
            $this->reset('name',
                         'max_age',
                         'type',
                         'category_id',
                        );
    }



   //EXTRAS
    //Ordena os colunas nas tabelas
    public function sortBy($field)
    {
        if ($field == $this->sortField) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    //pega o status do registro
    public function getStatus($id)
    {
        return Teams::where('id',$id)->first()->status;
    }

}

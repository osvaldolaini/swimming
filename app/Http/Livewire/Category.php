<?php

namespace App\Http\Livewire;

use App\Models\Model\Categories;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Category extends Component
{
    use WithPagination;

    public Categories $categories;
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
    public $type = '1';
    public $old_min;
    public $old_max;

    public $getStat;
    public bool $toggleStatus;

    public $detail;
    public $active = 1;
    public $name;
    public $code;
    public $birth_year;
    public $birth_year_end;
    public $rules;
    public $heads;
    public $model_id;

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

    public function render()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        return view('livewire.category');
    }


    //CREATE
    public function showModalCreate()
    {
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
                'name'=>'required|min:4|max:255',
                'birth_year'=>'required',
                'birth_year_end'=>'required',
                'type'=>'required',
        ];
        if ($this->type == 3) {
            $this->rules = [
                'old_min'=>'required',
                'old_max'=>'required',
            ];
        }


        $this->validate();

        Categories::create([
            'name'          =>ucwords(mb_strtolower($this->name)),
            'birth_year'    =>$this->birth_year,
            'birth_year_end'=>$this->birth_year_end,
            'active'        =>$this->active,
            'type'          =>$this->type,
            'old_min'       =>$this->old_min,
            'old_max'       =>$this->old_max,
            'code'          =>Str::uuid(),
            'created_by'    =>Auth::user()->name,
        ]);
            $this->openAlert('success','Registro criado com sucesso.');

            $this->alertSession = true;
            $this->showModalCreate = false;
            $this->reset('name',
                         'birth_year',
                         'birth_year_end',
                         'type',
                         'old_min',
                         'old_max'
                        );
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView= true;

        if (isset($id)) {
            $data = Categories::where('id',$id)->first();
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
    public function showModalUpdate(Categories $categories)
    {
        $this->model_id         = $categories->id;
        $this->name             = $categories->name;
        $this->birth_year       = $categories->birth_year;
        $this->birth_year_end   = $categories->birth_year_end;
        $this->type             = $categories->convertType;
        $this->old_min          = $categories->old_min;
        $this->old_max          = $categories->old_max;
        $this->active           = $categories->active;
        $this->showModalEdit    = true;
    }
    public function update()
    {
        $this->rules = [
            'name'=>'required|min:4|max:255',
            'birth_year'=>'required',
            'birth_year_end'=>'required',
            'type'=>'required',
        ];
        if ($this->type == 3) {
            $this->rules = [
                'old_min'=>'required',
                'old_max'=>'required',
            ];
        }

        $this->validate();

        Categories::updateOrCreate([
            'id'=>$this->model_id,
        ],[
            'name'          =>ucwords(mb_strtolower($this->name)),
            'birth_year'    =>$this->birth_year,
            'birth_year_end'=>$this->birth_year_end,
            'type'          =>$this->type,
            'old_min'       =>$this->old_min,
            'old_max'       =>$this->old_max,
            'active'        =>$this->active,
            'updated_by'    =>Auth::user()->name,
        ]);

        $this->openAlert('success','Registro atualizado com sucesso.');

            $this->alertSession = true;
            $this->showModalEdit = false;
            $this->reset('name',
            'birth_year',
            'birth_year_end',
            'type',
            'old_min',
            'old_max'
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
        $data = Categories::where('id',$id)->first();
        $data->active = '0';
        $data->save();
        $this->openAlert('success','Registro excluido com sucesso.');

            $this->alertSession = true;
            $this->showJetModal = false;
            $this->reset('name','birth_year','birth_year_end');
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
        return Categories::where('id',$id)->first()->status;
    }


}

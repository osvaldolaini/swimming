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

    public function render()
    {
        // Gate::authorize('admin');

        // $this->categories = Categories::all();
        $data = Categories::when($this->search, function($query,$search){
            return $query->where($this->selectFilter,'LIKE',"%$search%");
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

         $this->heads = [
            ['label' => 'Categoria','filter'=>true,'orderable' => true,'field'=>'name','direction'=>'asc'],
            ['label' => 'Ano','filter'=>true,'orderable' => true,'field'=>'birth_year','direction'=>'asc'],
            ['label' => 'Ano','filter'=>true,'orderable' => true,'field'=>'birth_year_end','direction'=>'asc'],
        ];

        return view('livewire.category',
        [
            'data'      => $data,
        ]
    );
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
        ];
        $this->validate();

        Categories::create([
            'name'      =>ucwords(mb_strtolower($this->name)),
            'birth_year'=>$this->birth_year,
            'birth_year_end'=>$this->birth_year_end,
            'active'    =>$this->active,
            'code'      =>Str::uuid(),
            'created_by'=>Auth::user()->name,
        ]);
        session()->flash('success','Registro criado com sucesso');

            $this->alertSession = true;
            $this->showModalCreate = false;
            $this->reset('name','birth_year','birth_year_end');
    }
    //READ
    public function showView($id)
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
    public function showModalEdit(Categories $categories)
    {
        $this->model_id = $categories->id;
        $this->name    = $categories->name;
        $this->birth_year    = $categories->birth_year;
        $this->birth_year_end    = $categories->birth_year_end;
        $this->active   = $categories->active;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'name'=>'required|min:4|max:255',
            'birth_year'=>'required',
            'birth_year_end'=>'required',
        ];
        $this->validate();

        Categories::updateOrCreate([
            'id'=>$this->model_id,
        ],[
            'name'      =>ucwords(mb_strtolower($this->name)),
            'birth_year'=>$this->birth_year,
            'birth_year_end'=>$this->birth_year_end,
            'active'    =>$this->active,
            'updated_by'=>Auth::user()->name,
        ]);

        session()->flash('success','Registro atualizado com sucesso');

            $this->alertSession = true;
            $this->showModalEdit = false;
            $this->reset('name','birth_year','birth_year_end');
    }
    //DELETE
    public function showModal($id)
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

        session()->flash('success','Registro excluido com sucesso.');

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
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
    //pega o status do registro
    public function getStatus($id)
    {
        return Categories::where('id',$id)->first()->status;
    }


}

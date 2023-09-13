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
    public $showJetModal= false;
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
    public function openAlert($status,$msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
    public function mount()
    {
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
        return view('livewire.relay');
    }

    //CREATE
    public function showModalCreate()
    {
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
                'name'          =>'required|min:4|max:255',
                'min_age'       =>'required',
                'max_age'       =>'required',
                'category_id'   =>'required',
        ];
        // dd($this->type);
        if ($this->type == 3) {
            $this->rules = [
                'old_min'=>'required',
                'old_max'=>'required',
            ];
        }
        $this->validate();

        Relays::create([
            'name'          =>ucwords(mb_strtolower($this->name)),
            'min_age'       =>$this->min_age,
            'max_age'       =>$this->max_age,
            'active'        =>$this->active,
            'category_id'   =>$this->category_id,
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
                         'min_age',
                         'max_age',
                         'category_id',
                         'old_min',
                         'old_max'
                        );
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView= true;

        if (isset($id)) {
            $data = Relays::where('id',$id)->first();
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
    public function showModalUpdate(Relays $relays)
    {
        $this->model_id         = $relays->id;
        $this->name             = $relays->name;
        $this->min_age          = $relays->min_age;
        $this->max_age          = $relays->max_age;
        $this->initial          = $relays->min_age;
        $this->final            = $relays->max_age + 1;
        $this->type             = $relays->convertType;
        $this->category_id      = $relays->category_id;
        $this->old_min          = $relays->old_min;
        $this->old_max          = $relays->old_max;
        $this->active           = $relays->active;
        $this->showModalEdit    = true;
    }
    public function update()
    {
        $this->rules = [
            'name'          =>'required|min:4|max:255',
            'min_age'       =>'required',
            'max_age'       =>'required',
            'category_id'   =>'required',
    ];
        if ($this->type == 3) {
            $this->rules = [
                'old_min'=>'required',
                'old_max'=>'required',
            ];
        }

        $this->validate();

        Relays::updateOrCreate([
            'id'=>$this->model_id,
        ],[
            'name'          =>ucwords(mb_strtolower($this->name)),
            'min_age'       =>$this->min_age,
            'max_age'       =>$this->max_age,
            'active'        =>$this->active,
            'category_id'   =>$this->category_id,
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
                         'min_age',
                         'max_age',
                         'category_id',
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
        $data = Relays::where('id',$id)->first();
        $data->active = '0';
        $data->save();
        $this->openAlert('success','Registro excluido com sucesso.');
            $this->alertSession = true;
            $this->showJetModal = false;
            $this->reset('name',
                         'min_age',
                         'max_age',
                         'category_id',
                         'old_min',
                         'old_max'
                        );
    }


//    //EXTRAS
//     //Ordena os colunas nas tabelas
//     public function sortBy($field)
//     {
//         if ($field == $this->sortField) {
//             $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
//         } else {
//             $this->sortField = $field;
//             $this->sortDirection = 'asc';
//         }
//     }

//     //pega o status do registro
//     public function getStatus($id)
//     {
//         return Relays::where('id',$id)->first()->status;
//     }


}

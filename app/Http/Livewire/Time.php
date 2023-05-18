<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Categories;
use App\Models\Model\Modalities;
use App\Models\Model\Times;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Time extends Component
{
    use WithPagination;

    public Times $times;
    public $search;
    public $sortField = 'day';
    public $sortDirection = 'asc';
    public $showJetModal = false;
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
    public $athlete_id;
    public $modality_id;
    public $category_id;
    public $record;
    public $code;
    public $day;
    public $rules;
    public $heads;
    public $model_id;
    public $modalities;
    public $athletes;

    public function mount()
    {
        $this->athletes = Athletes::where('active',1)->get();
        $this->modalities = Modalities::where('active',1)->get();
    }

    public function render()
    {
        // Gate::authorize('admin');

        $data = Times::when($this->search, function ($query, $search) {
            return $query->where($this->selectFilter, 'LIKE', "%$search%");
        })
            ->with(['athletes', 'modality'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $this->heads = [
            // ['label' => 'Categoria','filter'=>true,'orderable' => true,'field'=>'name','direction'=>'asc'],
            ['label' => 'Data', 'filter' => true, 'orderable' => true, 'field' => 'day', 'direction' => 'asc'],
        ];

        return view(
            'livewire.time',
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
            'athlete_id' => 'required',
            'day' => 'required',
            'record' => 'required',
            'modality_id' => 'required',
        ];
        $this->validate();

        $birth = Athletes::find($this->athlete_id)->birth;
        $d = explode('-', $birth);
        $this->category_id = Categories::select('name')->where('birth_year', $d[0])->first()->id;

        Times::create([
            'athlete_id'    => $this->athlete_id,
            'modality_id'   => $this->modality_id,
            'category_id'   => $this->category_id,
            'record'        => $this->record,
            'day'           => $this->day,
            'active'        => $this->active,
            'code'          => Str::uuid(),
            'created_by'    => Auth::user()->name,
        ]);
        session()->flash('success', 'Registro criado com sucesso');

        $this->alertSession = true;
        $this->showModalCreate = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record'
        );
    }
    //READ
    public function showView($id)
    {
        $this->showModalView = true;

        if (isset($id)) {
            $data = Times::where('id', $id)->first();
            // dd($data);
            $this->detail = [
                'Categoria'         => ucwords(mb_strtolower($data->name)),
                'Status'            => ($data->active == 1 ? 'Ativo' : 'Inativo'),
                'Criada'            => convertDate($data->created_at),
                'Criada por'        => $data->created_by,
                'Atualizada'        => convertDate($data->updated_at),
                'Atualizada por'    => $data->updated_by,
            ];
        } else {
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalEdit(Times $times)
    {
        $this->model_id     = $times->id;
        $this->athlete_id   = $times->athlete_id;
        $this->modality_id  = $times->modality_id;
        $this->record       = converTime($times->record);
        $this->day          = $times->day;
        $this->active       = $times->active;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'athlete_id' => 'required',
            'day' => 'required',
            'record' => 'required',
            'modality_id' => 'required',
        ];
        $this->validate();

        $birth = Athletes::find($this->athlete_id)->birth;
        $d = explode('-', $birth);
        $this->category_id = Categories::select('name')->where('birth_year', $d[0])->first()->id;

        Times::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'athlete_id'    => $this->athlete_id,
            'modality_id'   => $this->modality_id,
            'category_id'   => $this->category_id,
            'record'        => $this->record,
            'day'           => $this->day,
            'active'        => $this->active,
            'updated_by' => Auth::user()->name,
        ]);

        session()->flash('success', 'Registro atualizado com sucesso');

        $this->alertSession = true;
        $this->showModalEdit = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record'
        );
    }
    //DELETE
    public function showModal($id)
    {
        $this->showJetModal = true;
        if (isset($id)) {
            $this->registerId = $id;
        } else {
            $this->registerId = '';
        }
    }
    public function delete($id)
    {
        $data = Times::where('id', $id)->first();
        $data->active = '0';
        $data->save();

        session()->flash('success', 'Registro excluido com sucesso.');

        $this->alertSession = true;
        $this->showJetModal = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record'
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
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
    //pega o status do registro
    public function getStatus($id)
    {
        return Times::where('id', $id)->first()->status;
    }
}

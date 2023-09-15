<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Modalities;
use App\Models\Model\Teams;
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
    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $registerId;
    public $alertSession = false;

    public $detail;
    public $active = 1;
    public $athlete_id;
    public $modality_id;
    public $team_id;
    public $type_time = 'tomada';
    public $distance = 50;
    public $pool = 25;
    public $record;
    public $code;
    public $day;
    public $rules;
    public $heads;
    public $model_id;
    public $modalities;
    public $teams;
    public $athletes;

    protected $listeners =
    [
        'showModalCreate',
        'showModalRead',
        'showModalUpdate',
        'showModalDelete'
    ];

    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        $this->modalities = Modalities::where('active',1)->get();
        $this->teams = Teams::where('active',1)->get();
    }

    public function getAthletes()
    {
        $team = Teams::find($this->team_id);

        $this->athletes = Athletes::select('name','id')->where('active', 1)
        ->whereBetween('birth', [$team->birth_year . '-01-01', $team->birth_year_end . '-12-31'])
        ->get();
    }

    public function render()
    {
        return view('livewire.time');
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

        $this->day = implode(
            "-",
            array_reverse(explode("/", $this->day))
        );
        Times::create([
            'team_id'       => $this->team_id,
            'athlete_id'    => $this->athlete_id,
            'modality_id'   => $this->modality_id,
            'distance'      => $this->distance,
            'type_time'     => $this->type_time,
            'pool'          => $this->pool,
            'record'        => invertTime($this->record),
            'recordConverte' => $this->record,
            'day'           => $this->day,
            'active'        => 1,
            'code'          => Str::uuid(),
            'created_by'    => Auth::user()->name,
        ]);

        $this->openAlert('success','Registro criado com sucesso.');

        $this->showModalCreate = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record',
            'distance',
            'pool',
            'team_id',
            'type_time'
        );
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;

        if (isset($id)) {
            $data = Times::where('id', $id)->first();
            if ($data->athletes->register) {
                $image = imageProfile($data->athletes->register.'/'.$data->athletes->slug);
            }else{
                $image = url('storage/logo-gnu.svg');
            }
            $this->detail = [
                'Foto'              => $image,
                'Piscina'           => $data->pool,
                'Distancia'         => $data->distance,
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
    public function showModalUpdate(Times $times)
    {
        $this->model_id     = $times->id;
        $this->athlete_id   = $times->athlete_id;
        $this->modality_id  = $times->modality_id;
        $this->pool         = $times->pool;
        $this->distance     = $times->distance;
        $this->type_time    = $times->type_time;
        $this->record       = $times->recordConvert;
        $this->day          = $times->day;
        $this->active       = $times->active;
        $this->showModalEdit = true;

        if($this->team_id){
            $team = Teams::find($this->team_id);
            $this->athletes = Athletes::select('name','id')->where('active', 1)
            ->whereBetween('birth', [$team->birth_year . '-01-01', $team->birth_year_end . '-12-31'])
            ->get();
        }

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
        $this->day = implode(
            "-",
            array_reverse(explode("/", $this->day))
        );

        Times::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'team_id'       => $this->team_id,
            'athlete_id'    => $this->athlete_id,
            'modality_id'   => $this->modality_id,
            'distance'      => $this->distance,
            'type_time'     => $this->type_time,
            'pool'          => $this->pool,
            'record'        => invertTime($this->record),
            'recordConverte' => $this->record,
            'day'           => $this->day,
            // 'active'        => $this->active,
            'updated_by' => Auth::user()->name,
        ]);

        $this->openAlert('success','Registro atualizado com sucesso.');

        $this->showModalEdit = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record',
            'distance',
            'pool',
            'team_id',
            'type_time'
        );
    }
    //DELETE
    public function showModalDelete($id)
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
        $data->delete();

        $this->openAlert('success','Registro excluido com sucesso.');

        $this->showJetModal = false;
        $this->reset(
            'athlete_id',
            'day',
            'modality_id',
            'record'
        );
    }
    //pega o status do registro
    public function openAlert($status,$msg)
    {
        $this->emit('openAlert', $status, $msg);
    }
}

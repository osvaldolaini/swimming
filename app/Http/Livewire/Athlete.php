<?php

namespace App\Http\Livewire;

use App\Models\Model\Athletes;
use App\Models\Model\Teams;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Athlete extends Component
{
    // public Athletes $athletes;
    public $athletes = [];
    public $category;
    public $getCategory;
    public $cat;
    public $times;
    public $imageUrl;

    public $showJetModal= false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $alertSession = false;

    public $getStat;
    public bool $toggleStatus;
    public $rules;
    public $registerId;
    public $detail;
    public $model_id;

    public $sex;
    public $name;
    public $birth;
    public $nick;
    public $register_date;
    public $register;
    public $active;

    public function mount()
    {
        if (Gate::allows('group-user')) {
            abort(403);
        }
        if(isset($_GET['category'])){
            $this->getCategory = $_GET['category'];
            $this->category = Teams::select('name','min_age','max_age')->find($this->getCategory);
        }

    }

    public function loadPosts()
    {
        if (isset($this->getCategory)) {
            $this->category = Teams::select('id','name','min_age','max_age')->find($this->getCategory);
            $this->athletes = Athletes::select('id','nick','name','birth','sex')
            ->where('teams_configs_id',Auth::user()->team->id)
            ->where('active', 1)
            ->with('timess')
            ->whereBetween('birth', [$this->category->birth_year . '-01-01', $this->category->birth_year_end . '-12-31'])
            ->orderBy('name','asc')
            ->get();
        }
    }
    public function render()
    {

        return view('livewire.athlete');
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
                'birth'=>'required|max:255',
                'sex'=>'required|max:255',
        ];
        $this->validate();

        $this->birth = implode(
            "-",
            array_reverse(explode("/", $this->birth))
        );
        if($this->register_date != ''){
            $this->register_date = implode(
                "-",
                array_reverse(explode("/", $this->register_date))
            );
        }

        Athletes::create([
            'name'      =>mb_strtoupper($this->name),
            'nick'      =>mb_strtoupper($this->nick),
            'teams_configs_id' => Auth::user()->team->id,
            'register'  =>$this->register,
            'register_date'  =>$this->register_date,
            'active'    =>1,
            'sex'       =>$this->sex,
            'birth'     =>$this->birth,
            'code'      =>Str::uuid(),
            'created_by'=>Auth::user()->name,
        ]);
        session()->flash('success','Registro criado com sucesso');

            $this->alertSession = true;
            $this->showModalCreate = false;
            $this->reset(
                'name',
                'nick',
                'sex',
                'birth',
                'register',
                'register_date'
            );
            $this->mount();
    }
    //READ
    public function showView($id)
    {
        $this->showModalView= true;

        if (isset($id)) {
            $data = Athletes::where('id',$id)->first();
            // dd($data);
            if ($data->register) {
                $image = imageProfile($data->register.'/'.$data->slug);
            }else{
                $image = url('storage/site/logo-gnu.svg');
            }
            $this->detail = [
                'Foto'              => $image,
                'Exercício'         => $data->title,
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
    public function showModalEdit(Athletes $athletes)
    {
        $this->model_id = $athletes->id;
        $this->name     = $athletes->name;
        $this->nick     = $athletes->nick;
        $this->active   = $athletes->active;
        $this->register = $athletes->register;
        $this->sex      = $athletes->sex;
        $this->birth    = convertOnlyDate($athletes->birth);
        $this->register_date    = convertOnlyDate($athletes->register_date);
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'name'=>'required|min:4|max:255',
            'birth'=>'required|max:255',
            'sex'=>'required|max:255',
        ];
        $this->validate();

        $this->birth = implode(
            "-",
            array_reverse(explode("/", $this->birth))
        );
        if($this->register_date != ''){
            $this->register_date = implode(
                "-",
                array_reverse(explode("/", $this->register_date))
            );
        }

        Athletes::updateOrCreate([
            'id'=>$this->model_id,
        ],[
            'name'      =>mb_strtoupper($this->name),
            'nick'      =>mb_strtoupper($this->nick),
            'register'  =>$this->register,
            'register_date'  =>$this->register_date,
            'active'    =>$this->active,
            'sex'       =>$this->sex,
            'birth'     =>$this->birth,
            'updated_by'=>Auth::user()->name,
        ]);

        session()->flash('success','Registro atualizado com sucesso');

            $this->alertSession = true;
            $this->showModalEdit = false;
            $this->reset(
                'name',
                'nick',
                'sex',
                'birth',
                'register',
                'register_date'
            );

            // $this->mount();
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
        $data = Athletes::where('id',$id)->first();
        $data->active = '0';
        $data->save();

        session()->flash('success','Registro excluido com sucesso.');

            $this->alertSession = true;
            $this->showJetModal = false;
            $this->reset(
                'name',
                'nick',
                'sex',
                'birth',
                'register_date'
            );

            $this->mount();
    }
    //Fecha a caixa da mensagem
    public function closeAlert()
    {
        $this->alertSession = false;
    }
    //pega o status do registro
    public function getStatus($id)
    {
        return Athletes::where('id',$id)->first()->active;
    }


}


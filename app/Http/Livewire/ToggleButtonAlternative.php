<?php

namespace App\Http\Livewire;

  use Illuminate\Database\Eloquent\Model;
  use Livewire\Component;

  class ToggleButtonAlternative extends Component
  {
        public Model $model;
        public string $field;
        public bool $hasCorrect;
        public $width;
        public $q_id;
        public $alertSession = false;
        public $url = '/questoes';

        public function mount()
        {
            $this->hasCorrect = (bool) $this->model->getAttribute($this->field);
        }
        public function render()
        {
            return view('livewire.toggle-button-alternative');
        }

        public function updating($field, $value)
        {
            $this->q_id=$this->model->question->id;
            foreach ($this->model->question->alternatives as $key) {
                $key->setAttribute($this->field, 0)->save();
            }
            $this->model->setAttribute($this->field, $value)->save();
            $this->alertSession = true;
            return redirect('alternativas/'.$this->q_id)
            ->with('success','Questão criada com sucesso.');
        }
}

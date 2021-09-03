<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Azbuttons extends Component
{
    public $buttons;
    public $result = '';
    public $gameOver = false;

    public $letters=[];
    protected $listeners=['CheckLetterResult'=>'changeButtonStatus','gameOver'=>'hideKeyboard'];
    public function mount()
    {

        $abc = ['А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я','Ь','Ъ'];
        foreach ($abc as $letter){
        //array of letters and their statuses (initially unknown)
            $this->letters = array_merge($this->letters , [$letter=>'unknown']);
        }

    }
    public function render()
    {
        if(!$this->gameOver) {
            return view('livewire.azbuttons', ['letters' => $this->letters]);
        }
        else
        {
            if($this->result=='win') {
                return view('livewire.win');
            }
            else
            {
                return view('livewire.loss');
            }
        }

    }

    public function SendLetter($letter)
    {
        if($this->letters[$letter]=='unknown')
        {
            $this->emit('letterSelected', $letter);
        }
    }

    public function changeButtonStatus($letter)
    {
       $this->letters[array_keys($letter)[0]] =$letter[array_keys($letter)[0]];
    }

    public function hideKeyboard($result)
    {
        $this->gameOver = true;
        $this->result = $result;
        $this->letters = [];


    }

}

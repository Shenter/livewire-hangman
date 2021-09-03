<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HangmanImage extends Component
{
    public $image=0;

    public $listeners=['CheckLetterResult'=>'changeImage'];
    public function render()
    {
        return view('livewire.hangman-image');
    }

    public function changeImage($letter)
    {
        if($letter[array_keys($letter)[0]]=='wrong') {
            $this->image++;
        }
    }


}

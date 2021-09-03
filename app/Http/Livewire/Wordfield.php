<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\WordRepository;

class Wordfield extends Component
{
    public $guessedWord;
    public $errorsCount = 0;
    protected $listeners = ['letterSelected' => 'handleLetter'];
    private $wordRepository;
    public $gameOver = false;
    public $userArray = [];

    public function mount(string $guessedWord, WordRepository $wordRepository)
    {
        $this->guessedWord = $guessedWord;
        $this->wordRepository = $wordRepository;

        for ($i = 0; $i < count(preg_split('/(?<!^)(?!$)/u', $this->guessedWord)); $i++) {
            $this->userArray[] = '';
        }
    }

    public function checkForWin()
    {
        $guessedLettersCount = 0;
        foreach ($this->userArray as $letter) {

            if ($letter != '') {
                $guessedLettersCount++;
            }
            if (count($this->userArray) == $guessedLettersCount) {
                return true;
            }
        }
        return false;
    }


    public function handleLetter($letter)
    {
        if ($this->gameOver || in_array($letter, $this->userArray))//Must Not Happen if only not to send request from console
        {
            return;
        }
        $checkResult = $this->checkLetter($letter);
        if ($checkResult) {
            $this->emit('CheckLetterResult', [$letter => 'right']);
            if ($this->checkForWin()) {
                $this->emit('gameOver', 'win');
                $this->gameOver = true;
            }
        } else {
            $this->emit('CheckLetterResult', [$letter => 'wrong']);
            $this->errorsCount++;
            if ($this->checkForLoss()) {
                $this->emit('gameOver', 'loss');
                $this->fillUserArrayWithRedLetters();
                $this->gameOver = true;
            }
        }
    }



    public function checkLetter($letter): bool
    {
        $i = 0;
        $result = false;
        foreach (preg_split('/(?<!^)(?!$)/u', $this->guessedWord) as $item) {
            if ($item == $letter) {
                $this->userArray[$i] = $letter;
                $result = true;
            }
            $i++;
        }
        return $result;
    }


    public function render()
    {
        return view('livewire.wordfield');
    }


    public function checkForLoss(): bool
    {
        if ($this->errorsCount >= 6) {
            return true;
        }
        return false;
    }

    public function fillUserArrayWithRedLetters(): void
    {
        $correctAnswersArray = preg_split('/(?<!^)(?!$)/u', $this->guessedWord);
        for ($i = 0; $i < count($correctAnswersArray); $i++) {
            if ($this->userArray[$i] == '') {
                $this->userArray[$i] = '<span style="color:red" >' . $correctAnswersArray[$i] . '</span>';
            }
        }
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Word;
use Livewire\Component;

class Hangman extends Component
{

    public $spelledWord = [];
    public $foundLetters = [];
    public $randomLetters = [];
    public $word;
    public $category_id;
    public $categories;
    public $part = -1;


    public function mount()
    {
        $this->categories = Category::orderBy('category', 'ASC')->get();
    }

    public function selectLetter($letter)
    {
        if (count($this->foundLetters) < count($this->spelledWord)) {
            $exist = array_keys($this->spelledWord, $letter);

            $this->deleteSelectLetters($letter);
            if (count($exist) > 0) {
                foreach ($exist as $key) {
                    $this->foundLetters[$key] = $letter;
                }
            } else {
                $this->part++;
                $this->emit('wrongLetter', $this->part);
            }
        }
    }

    private function deleteSelectLetters($letter)
    {
        $toRemove = array_keys($this->randomLetters, $letter);
        foreach ($toRemove as $key) {
            unset($this->randomLetters[$key]);
        }
    }

    public function updatedCategoryId()
    {
        if ($this->category_id != '') {
            $this->restart();
        } else {
            $this->part = -1;
            $this->foundLetters = [];
        }
    }

    public function restart()
    {
        $this->part = -1;
        $this->foundLetters = [];
        $this->setWord();
        $this->emit('restart');
    }

    private function setWord()
    {
        $this->word = Word::getByCategory($this->category_id)->inRandomOrder()->first()->word;
        $this->spelledWord = str_split($this->word);
        $this->randomLetters = $this->randomWordLetters();
    }

    public function randomWordLetters($num = 25)
    {
        $num = $num - strlen($this->word);
        $str_result = 'abcdefghijklmnopqrstuvwxyz';
        $str_result = str_replace($this->spelledWord, '', $str_result);

        $str_result = substr(str_shuffle($str_result), 0, $num) . $this->word;
        $str_result = str_shuffle($str_result);
        return str_split($str_result);
    }


    public function render()
    {
        return view('livewire.hangman');
    }
}

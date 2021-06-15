<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;

// class Counter extends Component
class Counter extends Component
{
    //   public $count = 0;

    // public function increment()
    // {
    //     $this->count++;
    // }
    // public function decrement()
    // {
    //     $this->count--;
    // }
    // public function render()
    // {
    //     return view('livewire.counter');
    // }
    public $search = '';

    public function render()
    {
        return view('livewire.counter', [
            'users' => User::where('name', $this->search)->get(),
        ]);
    }
}

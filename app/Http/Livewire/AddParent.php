<?php

namespace App\Http\Livewire;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use Livewire\Component;

class AddParent extends Component
{
    public $currentStep = 1;

    public function render()
    {
        return view('livewire.add-parent',
    [
        'Nationalities'=>Nationality::all(),
        'Type_Bloods'=>BloodType::all(),
        'Religions'=>Religion::all(),

    ]);
    }
}

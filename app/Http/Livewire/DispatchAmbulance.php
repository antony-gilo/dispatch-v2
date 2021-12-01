<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Ambulance;
use App\Models\Dispatch;

class DispatchAmbulance extends Component
{
    public $locations;
    public $ambulance_array;

    public $name;
    public $caller_phone;
    public $kin_name;
    public $kin_phone;
    public $victim_name;
    public $victim_gender;
    public $location_id;
    public $driver_assigned;
    public $emergency_details;

    public $totalSteps = 3;
    public $currentStep = 1;

    public function mount()
    {
        $this->locations = Location::all();
        $this->ambulance_array = Ambulance::where('status', 0)->get();

        $this->currentStep = 1;
    }

    public function render()
    {
        return view('livewire.dispatch-ambulance');
    }

    public function increaseStep()
    {
        $this->currentStep++;

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->currentStep--;

        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }
}

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
    public $assigned_ambulance;
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
        $this->resetErrorBag();
        $this->validateData();

        $this->currentStep++;

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();

        $this->currentStep--;

        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {

            $this->validate([
                'name' => 'required | string | max:20',
                'caller_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'kin_name' => 'required | string | max:20',
            ]);
        } elseif ($this->currentStep == 2) {

            $this->validate([
                'kin_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'victim_name' => 'required | string | max:20',
                'victim_gender' => 'required',
            ]);
        }
    }

    public function dispatch()
    {
        if ($this->currentStep == 3) {

            $this->validateData([
                'location_id' => 'required',
                'assigned_ambulance' => 'required',
                'emergency_details' => 'required | text'
            ]);
        }

        $dispatch_info = [
            'name' => $this->name,
            'caller_phone' => $this->caller_phone,
            'kin_name' => $this->kin_name,
            'kin_phone' => $this->kin_phone,
            'victim_name' => $this->victim_name,
            'victim_gender' => $this->victim_gender,
            'location_id' => $this->location_id,
            'ambulance_id' => $this->assigned_ambulance,
            'emergency_details' => $this->emergency_details,
        ];

        $dispatched_ambulance = $dispatch_info['ambulance_id'];

        $ambulance_status = Ambulance::findOrFail($dispatched_ambulance);
        $ambulance_status->update(['status' => 1]);

        $insert = Dispatch::create($dispatch_info);

        if ($insert) {

            $this->reset();
            $this->currentStep == 1;
        }
    }
}

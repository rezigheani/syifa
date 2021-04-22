<?php

namespace App\Http\Livewire\DefaultComponent;

use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user_id = 0;

    public $nik;
    public $alamat;
    public $gender;
    public $nomor_hp;

    //nested address
    public $province;
    public $regency;
    public $district;
    public $village;

    public $rules = [
        'nomor_hp' => 'required',
        'nik' => 'required|min:16',
        'alamat' => 'required',
        'gender' => 'required',
        'village' => 'required'
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.default-component.profile');
    }

    public function saveProfileInformation()
    {
        $data = $this->validate();
        \App\Models\Profile::updateOrCreate(
            ['user_id' => $this->user_id  ? $this->user_id : Auth::user()->id],
            [
                'nik' => $this->nik,
                'alamat' => $this->alamat,
                'gender' => $this->gender,
                'nomor_hp' => $this->nomor_hp,
                'village_id' => $this->village,
            ]
        );
        request()->session()->flash('flash.banner', 'Yay it works!');
        $this->emit('saved');

    }
    public function mount()
    {
        $user = $this->user_id  ? user_id : Auth::user();
        $profile = \App\Models\Profile::where('user_id', $this->user_id  ? $this->user_id : Auth::user()->id)->first();
        $this->name = $user->name;

        if ($profile) {
            $this->nik = $profile->nik;
            $this->alamat = $profile->alamat;
            $this->gender = $profile->gender;
            $this->nomor_hp = $profile->nomor_hp;
            if ($profile->village_id) {
                $this->village = $profile->village_id;
                $this->district = Village::where('id',$profile->village_id)->first()->district_id;
                $this->regency = District::where('id',$this->district)->first()->regency_id;
                $this->province = Regency::where('id',$this->regency)->first()->province_id;

            }
        }
    }
}

    <x-jet-form-section submit="saveProfileInformation">
        <x-slot name="title">
            {{ __('Additional Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your additional profile information.') }}
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nik" value="{{ __('NIK') }}" />
                <x-jet-input id="nik" type="text" class="mt-1 block w-full" wire:model="nik" autocomplete="nik" />
                <x-jet-input-error for="nik" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <x-select :option="App\Models\Profile::gender()" value="" name="gender" />
                <x-jet-input-error for="gender" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nomor_hp" value="{{ __('Nomor HP') }}" />
                <x-jet-input id="nomor_hp" type="number" class="mt-1 block w-full" wire:model="nomor_hp" autocomplete="nomor_hp" />
                <x-jet-input-error for="nomor_hp" class="mt-2" />
            </div>
            {{--alamat lengkap--}}
            <div class="col-span-6 sm:col-span-4">
                <div class="col-span-3 sm:col-span-2">
                    <x-jet-label for="province" :value="__('Provinsi')"/>
                    <x-select :option="App\Models\Province::all()->pluck('name','id')->prepend('Pilih','0')" value="" name="province" />
                </div>
            </div>

            @if($province)
            <div class="col-span-6 sm:col-span-4">
                <div class="col-span-3 sm:col-span-2">
                    <x-jet-label for="regency" :value="__('Kabupaten / Kota')"/>
                    <x-select name="regency" :option="App\Models\Regency::where('province_id',$province)->get()->pluck('name','id')->prepend('Pilih','0')" value=""/>
                </div>
            </div>
            @endif

            @if($regency)
                <div class="col-span-6 sm:col-span-4">
                    <div class="col-span-3 sm:col-span-2">
                        <x-jet-label for="district" :value="__('Kecamatan')"/>
                        <x-select :option="App\Models\District::where('regency_id',$regency)->pluck('name','id')->prepend('Pilih','0')" value="" name="district"/>
                    </div>
                </div>
            @endif

            @if($district)
                <div class="col-span-6 sm:col-span-4">
                    <div class="col-span-3 sm:col-span-2">
                        <x-jet-label for="villae" :value="__('Desa')"/>
                        <x-select :option="App\Models\Village::where('district_id',$district)->pluck('name','id')->prepend('Pilih','0')" value="" name="village" />
                    </div>
                </div>
            @endif

            <div class="col-span-6 sm:col-span-6">
                <x-jet-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                <x-jet-input id="alamat" type="text" class="mt-1 block w-full" wire:model="alamat" autocomplete="alamat" />
                <x-jet-input-error for="alamat" class="mt-2" />
            </div>
            {{--end alamat lengkap--}}
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>
            <x-jet-button wire:loading.attr="disabled" wire:target="saveProfileInformation">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

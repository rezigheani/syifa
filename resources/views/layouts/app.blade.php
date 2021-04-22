<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" ></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
        <x-alert/>
        @stack('js')

        <script>
            function dropdown(value,data_value = "") {
                return {
                    options: [],
                    selected: [],
                    show: false,
                    open() { this.show = true },
                    close() { this.show = false },
                    search(){ console.log(this.input.value())},
                    isOpen() { return this.show === true },
                    select(index, event) {
                        if (!this.options[index].selected) {
                            console.log(event.target,)
                            this.options[index].selected = true;
                            // this.options[index].element = event.target;
                            this.selected.push(index);


                        } else {
                            this.selected.splice(this.selected.lastIndexOf(index), 1);
                            this.options[index].selected = false
                        }
                        let select_value = document.getElementById('select-value-'+value);
                        select_value.value = this.selected.map((option)=>{
                            return this.options[option].value;
                        }).toString()
                        select_value.dispatchEvent(new Event('input'));
                    },
                    remove(index, option) {

                        this.options[option].selected = false;
                        this.selected.splice(index, 1);

                        let select_value = document.getElementById('select-value-'+value);
                        select_value.value = this.selected.map((option)=>{
                            return this.options[option].value;
                        }).toString()
                        select_value.dispatchEvent(new Event('input'));


                    },
                    loadOptions() {
                        const options = document.getElementById('select-'+value).options;
                        for (let i = 0; i < options.length; i++) {

                            this.options.push({
                                value: options[i].value,
                                text: options[i].innerText,
                                selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                            });
                            if (data_value.includes(options[i].innerText)){
                                this.options[i].selected = true;
                                this.selected.push(i);
                            }
                        }


                    },
                    selectedValues(){
                        return this.selected.map((option)=>{
                            return this.options[option].value;
                        }).toString()
                    }
                }
            }
        </script>


    </body>
</html>

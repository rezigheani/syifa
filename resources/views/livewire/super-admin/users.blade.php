<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Pengguna</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                pengaturan pengguna
                            </p>
                        </div>
                    </div>
                    <div class="mt-1 md:mt-0 md:col-span-2 lg:col-span-2">
                        <div class=" sm:rounded-md">
                            <div class="bg-white  shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <div>
                                        <x-default-input type="text" nama="name" title="Pencarian"/>
                                    </div>
                                    <div class="text-right">
                                        <x-jet-button class="">
                                            {{--                                            <x-spinner wire:target="save"/>--}}
                                            find
                                        </x-jet-button>
                                    </div>
                                </div>
                            </div>

                            @if($table->count() > 0)
                                <table
                                    class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg sm:shadow-lg my-5">
                                    <thead class="">
                                    @foreach($table as $item)
                                        <tr class="bg-gray-700 flex flex-col flex-no wrap sm:table-row text-xs rounded-l-lg sm:rounded-none mb-2 sm:mb-0 text-white">
                                            <th class="p-3 text-left  h-15 ">No</th>
                                            <th class="p-3 text-left  h-15">
                                                <div class="h-10">Nama</div>
                                            </th>
                                            <th class="p-3 text-left  h-15">
                                                <div class="h-14">Role</div>
                                            </th>
                                            <th class="p-3 text-left  h-15">Aksi</th>
                                        </tr>
                                    @endforeach
                                    </thead>
                                    <tbody class="flex-1 sm:flex-none">
                                    @foreach($table as $key => $item)
                                        <tr class="flex flex-col flex-no wrap sm:table-row text-xs mb-2 sm:mb-0 bg-white">
                                            <td class="border-grey-light h-15 hover:bg-gray-100 p-3">{{$key+1}}</td>
                                            <td class="border-grey-light border-t-2 h-15 hover:bg-gray-100 p-3 truncate">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <a href="#" class="block relative">
                                                            <img alt="profil" src="{{ $item->profile_photo_url }}"
                                                                 class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                                        </a>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{$item->name}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-grey-light h-15 hover:bg-gray-100 p-3">
                                                @livewire('super-admin.change-role',['user_id'=>$item->id],key('edit-role-'.$item->id))
                                            </td>
                                            <td class="border-grey-light border-t-2 h-15 hover:bg-gray-100 p-3 truncate">
                                                <button onclick="confirm('Apakah anda yakin mereset password : {{$item->name}}') && @this.resetPassword({{$item->id}})">Reset Password</button>
                                                |
                                                <button wire:click="setUserId({{$item->id}})">Edit</button>
                                                |
                                                <button
                                                    onclick="confirm('Apakah anda yakin menghapus: {{$item->name}}') && @this.removeUser({{$item->id}})">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {!! $table->links() !!}
                            @else
                                <div class="flex flex-row mb-1 sm:mb-0 justify-between mt-3 w-full text-center">
                                    <div class="mx-auto">
                                        Tidak Ada Data
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    {{--content here--}}
                </div>
            </div>
        </div>
    </div>
    @if($user_id)
    <x-jet-dialog-modal wire:model="editable">
        <x-slot name="title">
            {{ __('Edit User :') }} {{\App\Models\User::find($user_id)->name}}
        </x-slot>
        <x-slot name="content">
                @livewire('default-component.profile',['user_id'=>$user_id],key('user-profile-'.$user_id))
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>
    @endif
    <x-jet-dialog-modal wire:model="add">
        <x-slot name="title">
            {{ __('Add User :') }}
        </x-slot>
        <x-slot name="content">
            @livewire('default-component.profile',['user_id'=>$user_id],key('user-profile-'.$user_id))
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>

    <style>
        html,
        body {
            height: 100%;
        }

        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>
</div>

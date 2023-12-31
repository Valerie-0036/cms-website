<div class="w-full h-full p-5 grid grid-cols-8 grid-rows-6 gap-5">
    <div class="w-full p-5 col-span-4 row-span-1 rounded-lg bg-white shadow-lg">
        <h2 class="text-3xl font-semibold">Operators in this System is listed here.</h2>
        <p class="text-md text-gray-400">Who are they I wonder?</p>
    </div>

    <div class="w-full p-5 col-span-4 row-span-1 rounded-lg bg-white shadow-lg">
        <div class="mb-3">
            <label class="text-xl font-semibold" for="text-search-operators">Search</label><br>
            <input class="w-full px-3 py-1 border-2 rounded-md focus:outline-blue-400" wire:model="search" type="text"
            id="text-search-operators" 
            name="search-operators"
            placeholder="Search Operators"
            >
        </div>
    </div>

    <div class="w-full p-5 col-span-2 row-span-1 rounded-lg bg-white shadow-lg">
        <div class="w-full h-full flex gap-5">
            <a href="/admin/OpEditor" class="w-full h-full p-3 relative group border-2 rounded-lg shadow-md hover:cursor-pointer">
                <div class="w-full h-full flex justify-center items-center group-hover:opacity-0 transition-opacity">
                    <img class="w-full h-full" src="{{ asset('assets/admin/Operator/AddUser.svg') }}" alt="">
                </div>
                <div class="top-0 left-0 w-full h-full absolute flex justify-center items-center bg-gray-300 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg text-center font-semibold">
                    Operator
                </div>
            </a>
            <a class="w-full h-full p-3 relative group border-2 rounded-lg shadow-md hover:cursor-pointer">
                <div class="w-full h-full flex justify-center items-center group-hover:opacity-0 transition-opacity">
                    <img class="w-full h-full" src="{{ asset('assets/admin/Operator/Key.svg') }}" alt="">
                </div>
                <div class="top-0 left-0 w-full h-full absolute flex justify-center items-center bg-gray-300 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg text-center font-semibold">
                    Role
                </div>
            </a>
        </div>
    </div>

    <div class="w-full p-5 col-span-6 row-span-5 flex flex-col gap-3 rounded-lg bg-white shadow-lg overflow-y-scroll no-scrollbar">
        @foreach($operators as $operator)
        <div class="w-full p-5 border rounded-lg shadow-md">
            <div wire:ignore.self id="operator-{{ $operator->name }}" class="h-full flex flex-col gap-5 justify-between items-start">
                <div class="w-full flex justify-between items-center">
                    <div class="w-full flex gap-5 items-center">
                        <div class="w-14 h-full rounded-full">
                            <img class="w-full h-full rounded-full" src="{{ asset('assets/admin/Person.jpg')}}" alt="">
                        </div>
                        <div class="h-full flex flex-col justify-center">
                            <h6 class="text-xl font-medium">{{ $operator->name }}</h6>
                            <p class="text-md text-gray-600">{{ $operator->role }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="w-14 h-full rounded-full">
                            <a href="#" onclick="return toggle('data-{{ $operator->name }}')"><img class="w-full h-full rounded-full hover:bg-gray-100" src="{{ asset('assets/admin/Ellipsis.svg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="data-{{ $operator->name }}" class="w-full h-full hidden">
                    <form wire:submit.prevent="saveOperatorChanges({{ $operator->id }})">
                        <div class="mb-3">
                            <label class="text-xl font-semibold" for="text-{{ $operator->name }}">Name</label><br>
                            <input wire:model="operatorNames.{{ $operator->id }}" class="w-full px-3 py-1 border-2 rounded-md focus:outline-blue-400" type="text"
                            id="text-{{ $operator->name }}" 
                            placeholder="Operator Name"
                            >
                        </div>
                        @if ($errors->get('operatorNames.'.$operator->id))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg" role="alert">
                            <span class="font-medium">{{ $errors->get('operatorNames.'.$operator->id)[0] }}</span>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="text-xl font-semibold" for="email-{{ $operator->email }}">Email</label><br>
                            <input wire:model="operatorEmails.{{ $operator->id }}" class="w-full px-3 py-1 border-2 rounded-md focus:outline-blue-400" type="email"
                            id="email-{{ $operator->email }}"
                            placeholder="Operator Email"
                            >
                        </div>
                        @if ($errors->get('operatorEmails.'.$operator->id))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg" role="alert">
                            <span class="font-medium">{{ $errors->get('operatorEmails.'.$operator->id)[0] }}</span>
                        </div>
                        @endif
                        <x-form-input.image label="Image" name="image" img="{{ asset('/assets/form/pompom-ok.png') }}" width="150" height="150"></x-form-input.image>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="w-full p-5 col-span-2 row-span-4 flex flex-col gap-3 rounded-lg bg-white shadow-lg overflow-y-scroll no-scrollbar">
        @foreach($roles as $role)
        <div wire:click="chooseRole('{{ $role->role }}')" class="w-full h-24 p-5 flex gap-5 justify-center items-center border rounded-lg shadow-md hover:brightness-50 hover:cursor-pointer">
            <div class="text-center">
                {{ $role->role }}
            </div>
        </div>
        @endforeach
    </div>

    <script type='text/javascript'>
        function toggle(data)
        {
            let operatorData = document.getElementById(data);
            operatorData.classList.toggle('hidden')
        }
    </script>
</div>

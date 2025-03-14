<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles / Edit
            </h2>

            <a href="{{route('roles.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{route('roles.update', $role->id )}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="" class="text-lg font-medium"> Name</label>
                        <div class="my-3">
                            <input type="text" 
                            value="{{old('name', $role->name)}}"
                            name="name"
                            class="border-gray-300 shadow-sm w-1/2 rounded-lg" 
                            placeholder="Enter Permission Name">

                            @error('name')
                            <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <h3 class="my-3">Permissons for this Role</h3>
                        <hr>
                        <div class="grid grid-cols-4 mb-3">

                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission )

                                <div class="mt-3">
                                    <input 
                                    id="permission-{{$permission->id}}"
                                
                                    {{($hasPermissions->contains($permission->name)) ? 'checked' : ''}} 
                                    {{-- marca los que tiene asignado  --}}
                                    type="checkbox" 
                                    class="rounded"
                                    name="permission[]"
                                    value="{{$permission->name}}">

                                    <label 
                                    for="permission-{{$permission->id}}">{{ $permission->name}}</label>
                                </div>
                                    
                                @endforeach
                            
                                
                            @endif
                          
                        </div>


                        <button class="bg-slate-700 hover:bg-slate-600 text-sm rounded-md text-white px-5 py-3">Update</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

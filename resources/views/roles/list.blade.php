<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>

            <a href="{{route('roles.create')}}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- *************** Messagess ************* --}}
          <x-message></x-message>

          <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Permisssions</th>
                    <th class="px-6 py-3 text-left" width="150">Created</th>
                    <th class="px-6 py-3 text-center" width="180">Action</th>
                </tr>
            </thead>
            
            <tbody class="bg-white">
               
                @if($roles->isNotEmpty())
                @foreach ($roles  as $role )

                <tr>
                    <td class="px-6 py-3 text-left">{{ $role->id }}</td>
                    <td class="px-6 py-3 text-left"> {{ $role->name }}</td>
                    <td> 
                        {{$role->permissions->pluck('name')->implode(', ')}}
                    </td>
                    <td class="px-6 py-3 text-left"> {{ \Carbon\Carbon::parse($role->create_at)->format('d M, Y') }} </td>
                    <td class="px-6 py-3 text-center">

                        {{-- edit  --}}
                        <a href="{{route("roles.edit", $role->id)}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>

                        {{-- delete  --}}
                        <a href="javascript:void(0)" onclick="deleteRole({{$role->id}})" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>

                    </td>
                </tr>
                    
                @endforeach
                @endif
              
            </tbody>
        </table>

        {{-- paginations  --}}
            <div class="my-3">

                {{$roles->links()}}

            </div>
        </div>
    </div>

    {{-- js  --}}
    <x-slot name="script">
        <script type="text/javascript">

        function deleteRole(id){
            if(confirm("Are you sure want to delete?")){
                $.ajax({
                    url: '{{route("roles.destroy")}}',
                    type: 'delete',
                    data: {id:id},
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{csrf_token()}}'
                    },
                    success : function(response){
                        window.location.href = '{{ route("roles.index")}}'
                    }
                })
            }
        }
        </script>
    </x-slot>
</x-app-layout>

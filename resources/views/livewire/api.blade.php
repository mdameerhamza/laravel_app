<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Api's
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Api</button>
                @if($isOpen)
                    @include('livewire.api.create')
                @endif
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Consumer Key</th>
                            <th class="px-4 py-2">Consumer Secret</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apis as $a)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $a->name }}</td>
                                <td class="border px-4 py-2">{{ $a->consumer_key }}</td>
                                <td class="border px-4 py-2">{{ $a->consumer_secret }}</td>
                                <td class="border px-4 py-2">{{ $a->status === 0 ? 'Deactive' : 'Active' }}</td>
                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $a->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button wire:click="delete({{ $a->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

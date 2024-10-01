<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task Mangement System
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">No. OF Images</th>
                            <th class="px-4 py-2">Detail</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <div wire:key="{{ $task->id }}">
                                @if($task->status === '0')
                                    <tr class="text-center" >
                                        <td class="border px-4 py-2">{{ $task->title }}</td>
                                        <td class="border px-4 py-2">{{ $task->no_of_images }}</td>
                                        <td class="border px-4 py-2">{{ $task->detail }}</td>
                                        <td class="border px-4 py-2">
                                            <button wire:click="starttask({{ $task->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Start Task</button>
                                        </td>
                                    </tr>
                                @elseif($task->status === '1')
                                    <tr class="cursor-pointer text-center" wire:click.defer="in_progress({{ $task->id }})">
                                        <td class="border px-4 py-2">{{ $task->title }}</td>
                                        <td class="border px-4 py-2">{{ $task->no_of_images }}</td>
                                        <td class="border px-4 py-2">{{ $task->detail }}</td>
                                        <td class="border px-4 py-2">
                                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">In Progress</button>
                                        </td>
                                    </tr>
                                @endif
                            </div>
                        @endforeach

                    </tbody>

                </table>
                @if(count($tasks) === 0)
                    <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                            <p class="text-sm">No data</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

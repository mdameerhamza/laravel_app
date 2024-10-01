<div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Task Mangement System
    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white max-w-sm mx-auto rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <label class="underline font-bold text-2xl">Title:-</label>
                <div class="font-bold text-xl mb-2 mt-1">{{ $task->title }}</div>

                <label class="underline font-bold text-2xl">No of Images:-</label>
                <div class="font-bold text-xl mb-2 mt-1">{{ $task->no_of_images }}</div>

                <label class="underline font-bold text-2xl">Detail:-</label>
                <div class="font-bold text-xl mb-2 mt-1">{{ $task->detail }}</div>
            </div>
            <div class="px-6 pt-4 pb-2 text-center">
                <button class="completed bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Complete</button>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="mb-2 xl:w-96">
        <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
            <input class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="text" wire:model="img">
            <button class="mt-3 btn inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" wire:click="search">Search</button>
        </div>
    </div>
</div>

@if($showImages === 1)
<form action="form" method="POST">
    <div class="flex flex-row container mx-auto space-y-2 lg:space-y-0 lg:gap-2 lg:grid lg:grid-cols-6">
        @foreach($images as $image)
            @livewire('images',['image' => $image],key($image['id']))
        @endforeach
    </div>
</form>
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"  />
<script>


    document.addEventListener('livewire:load', function () {
        window.livewire.on('alert', param => {
            toastr[param['type']](param['message']);
            if (param['type'] == "success"){
                setTimeout(function () {
                    $(".modal").modal("hide");
                    window.location.href = param['url'];

                }, 300);
            }


        });

        $("body").on('click','.completed', function () {
            var selected = [];
            $(".image_checkbox").each(function (key, value) {
                if($(this).is(':checked')){
                    selected.push(value.value);
                }
            });
            if(selected.length === @this.required_images){
                @this.submit_task(selected);
            }else{
                let count = @this.required_images;
                toastr.info(`Please select ${@this.required_images} images`);
            }

        });
    });

</script>
</div>







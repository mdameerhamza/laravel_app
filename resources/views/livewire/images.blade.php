
<div >
    <div class="w-full rounded hover:shadow-2xl">
        <img src="{{ $image['assets']['preview']['url'] }}" alt="image" style="height:200px;">
        <input class="image_checkbox form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"  type="checkbox"  value="{{ $image['assets']['preview']['url'] }}">
        <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
            {{ $image['id'] }}
        </label>
    </div>

</div>

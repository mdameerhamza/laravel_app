{!! isset($blok['_editable']) ? $blok['_editable'] : '' !!}
<div class="grid">
    
  @foreach(Arr::get($blok, 'columns', []) as $blok)
      @include('components/' . $blok['component'], ['blok' => $blok])
  @endforeach
</div>
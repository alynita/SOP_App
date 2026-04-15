@extends('layouts.app')

@section('content')

<h5>Flowchart SOP</h5>

<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>

<div class="mermaid">
@verbatim
graph TD
Start([Start])
@endverbatim

@foreach($sop->kegiatan as $k)

@if($k->tipe == 'decision')
    K{{ $k->id }}{"{{ $k->nama_kegiatan }}"}
@else
    K{{ $k->id }}["{{ $k->nama_kegiatan }}"]
@endif

@if(!$loop->first)
    K{{ $sop->kegiatan[$loop->index - 1]->id }} --> K{{ $k->id }}
@endif

@endforeach

@verbatim
@endverbatim
</div>

<script>
mermaid.initialize({ startOnLoad: true });
</script>

@endsection
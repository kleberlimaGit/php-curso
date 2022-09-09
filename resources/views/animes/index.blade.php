<x-layout title="Animes">
		
		@isset($mensagemSucesso)
		<div class="alert alert-success">
			{{ $mensagemSucesso }}
		</div>
		@endisset
		
		@isset($mensagemErro)
		<div class="alert alert-danger">
			{{ $mensagemErro }}
		</div>
		@endisset
	<a href="{{ route('animes.create') }}" class="btn btn-primary mb-3">Adicionar Anime</a>
    
    <ul class="list-group">
    @if(isset($animes) && $animes->count() < 1)
    <li class="list-group-item d-flex justify-content-between aling-items-center list">
    	<span class="my-auto">Nenhum anime cadastrado até o momento</span>
    </li>
    @endif
    @foreach ($animes as $anime)
    
    	<li class="list-group-item d-flex justify-content-between aling-items-center list-hover" role="button">
    		<span class="my-auto">{{ $anime->name }}</span>
    		<form action = "{{ route('animes.destroy', $anime->id) }}" method="post">
    		@csrf
    			<a class="btn btn-success btn-sm mr-2" href="{{route('animes.edit', $anime->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
    			<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
    		</form>
        </li>
	@endforeach
	
    </ul>
	
</x-layout>
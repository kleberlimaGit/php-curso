<x-layout title="Novo Anime">	
		<form action="{{ route('animes.store') }}" method="post" class="form-group">
		@csrf		
			<a href="/animes" class="btn btn-primary mb-3"><i class="fa-solid fa-arrow-left mr-2"></i>Voltar</a>
        	<div class="mb-3 row">
        		<div class="col-md-6 col-12">
            		<label for="name" class="form-label">Nome</label>
            		<input type="text" 
        			   name="name"
        			   placeholder="Anime"
        			   autofocus 
        			   id="name"
        			   class="form-control"
        			   value="{{ old('name') }}">
        		</div>
        		<div class="col-md-3">
        			<label for="season">Temporadas</label>
        			<input type="number"
        				name="seasons"
        				min="1"
        				placeholder="Temporadas"
        				id="season"
        				class="form-control"
        				value="{{ old('season') }}">
        		</div>
        		<div class="col-md-3">
        			<label for="episode">Episódios por temporada</label>
        			<input type="number"
        					name="episodes"
        					min="1"
        					placeholder="Episódios"
        					id="episodes"
        					class="form-control"
        					value="{{ old('episodes') }}">
        		</div>
        			   
        	</div>
        	<button class="btn btn-primary col-md-2">Adicionar</button>			
	</form>
</x-layout>

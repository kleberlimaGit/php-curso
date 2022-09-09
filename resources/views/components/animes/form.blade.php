	<form action="{{ $action }}" method="post" class="form-group">
		@csrf		
			<a href="/animes" class="btn btn-primary btn-lg mb-3"><i class="fa-solid fa-arrow-left"></i></a>
        	<div class="mb-3">
        		<label for="nome" class="form-label">Nome: </label>
        		<input title="text" 
        			   name="name"
        			   placeholder="Anime" 
        			   id="name"
        			   class="form-control col-md-6"
        			   @isset($name) value="{{ $name }}" @endisset >
        	</div>
        	<button class="btn btn-primary col-md-2">Adicionar</button>			
	</form>
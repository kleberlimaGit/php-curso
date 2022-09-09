<x-layout title="Editar Anime">
	<x-animes.form :action="route('animes.update', $anime->id)" :name="$anime->name" />
</x-layout>
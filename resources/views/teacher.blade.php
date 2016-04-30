@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Below Are Your Pupils</h1>
		</div>

		<pupils list="{{ $pupils }}"></pupils>

		<template id="pupils-template">
			<ul id="mainContainerFiles">
				<li v-for="pupil in list | filterBy fileSearch in 'name' | orderBy 'name'">
					<a class="mainContainerFileTitle" href="pupil/@{{ pupil.user_id }}">
						<div class="mainContainerFile">
							@{{ pupil.name | truncate '20' }} 	
						</div>
					</a>
				</li>
			</ul>
		</template>

		<div id="mainContainerTitle">
			<h1>Below Are Files To Be Marked</h1>
		</div>

		@foreach($toBeMarked as $markFile)	
			<ul id="mainContainerFiles">
				<a class="mainContainerFileTitle" href="download/{{ $markFile->file_id }}">
					<div class="mainContainerFile">
						{{ $markFile->filename }} 
					</div>
					<form method="post" action="setMark/{{$markFile->file_id}}">
						{{ method_field('PATCH')}}
						{{ csrf_field() }}
						<div>
							<input type="text" name="mark" placeholder="Mark..."></input>
							<input type="hidden" name="marked" value="1"></input>
							<input type="submit" name="submit" value="Submit"></input>
						</div>
					</form>
				</a>
			</ul>
		@endforeach

	</main>

@stop
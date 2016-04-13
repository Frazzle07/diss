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
	</main>

@stop
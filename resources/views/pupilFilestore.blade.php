@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Files for "{{ $pupil }}"</h1>
		</div>

		<files list="{{ $files }}"></files>

		<template id="files-template">			
			<ul id="mainContainerFiles">
					<li v-for="file in list | filterBy fileSearch in 'name' | orderBy 'name'">
						<a class="mainContainerFileTitle" href="/download/@{{ file.id }}">
							<div class="mainContainerFile">
								@{{ file.name | truncate '20' }} 	
							</div>
						</a>
					</li>
			</ul>
		</template>
	</main>

@stop
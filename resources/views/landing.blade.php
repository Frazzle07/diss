@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Below Are Your Stored Files</h1>
		</div>

    	{{ Form::open(array('route' => array('pupil.file.upload', Auth::user()->id), 'files'=>true, 'method' => 'post')) }}
		{{ Form::file('files[]', array('multiple'=>true)) }}
		{{ Form::submit() }}
    	{{ Form::close() }}
		
		<files list="{{ $files }}"></files>

		<template id="files-template">	
			<ul id="mainContainerFiles">
				<li v-for="file in list | filterBy fileSearch in 'name' | orderBy 'name'">
					<a class="mainContainerFileTitle" href="download/@{{ file.id }}">
						<div class="mainContainerFile">
							@{{ file.name | truncate '20' }} 
							<div class="mainContainerFileMark">
								@{{ file.mark }} 
							</div>
						</div>
						<div>
							<a class="mainContainerFileDelete" href="delete/@{{ file.id }}">Delete</a>
							<a class="mainContainerFileDelete" href="mark/@{{ file.id }}">Send for Marking</a>
						</div>
					</a>
				</li>
			</ul>
		</template>

		<div id="mainContainerTitle">
			<h1>Files Waiting To Be Marked</h1>
		</div>

		@foreach($toBeMarked as $markFile)	
			<ul id="mainContainerFiles">
				<li>{{$markFile->filename}}</li>
			</ul>
		@endforeach

@stop

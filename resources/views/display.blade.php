@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			@if( isset($teacher))
				<h1>Details For {{$teacher->name}}</h1>
			@endif
			@if( isset($pupil))
				<h1>Details For {{$pupil->name}}</h1>
			@endif
			@if( isset($parent))
				<h1>Details For {{$parent->name}}</h1>
			@endif
		</div>

		@if( isset($teacher))
			<p>Name: {{$teacher->name}}</p>
			<p>User ID: {{$teacher->user_id}}</p>
			<p>Classroom: {{$teacher->classroom_id}}</p>
			<a href=#>Save</a>
			<a href=#>Delete</a>
		@endif

		@if( isset($pupil))
			<div class="search_details">
				<p>Name: {{$pupil->name}}</p>
				<p>User ID: {{$pupil->user_id}}</p>
				<p>Classroom: {{$pupil->classroom_id}}</p>
			</div>
			<div id="mainContainerTitle">
				<h1>User's Files</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($files as $file)
			    	<a class="mainContainerFileTitle" href="/download/{{ $file->id }}">
						<div class="mainContainerFile">
							{{ $file->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
			<a href=#>Save</a>
			<a href=#>Delete</a>
		@endif

		@if( isset($parent))
			<p>Name: {{$parent->name}}</p>
			<p>User ID: {{$parent->user_id}}</p>
			@foreach($children as $child)
				<p>Name: {{$child->name}}</p>
				<p>User ID: {{$child->user_id}}</p>
				<p>Classroom: {{$child->classroom_id}}</p>
			@endforeach
			<a href=#>Save</a>
			<a href=#>Delete</a>
		@endif

@stop

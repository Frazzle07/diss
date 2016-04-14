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
			@if( isset($classroom))
				<h1>Details For {{$classroom->name}}</h1>
			@endif
			@if( isset($admin))
				<h1>Details For {{$admin->name}}</h1>
			@endif
		</div>

		@if( isset($teacher))
			<div class="search_details">
				<form method="POST" action="/teacher/{{$teacher->id}}">
					<p>ID: {{$teacher->id}}</p>
					<p>Name: {{$teacher->name}}</p>
					<p>User ID: {{$teacher->user_id}}</p>
					<p>Classroom: {{$teacher->classroom_id}}</p>
					<a href=#>Save</a>
					<a href=#>Delete</a>
				</form>
			</div>
		@endif

		@if( isset($admin))
			<div class="search_details">
				<p>ID: {{$admin->id}}</p>
				<p>Name: {{$admin->name}}</p>
				<p>User ID: {{$admin->user_id}}</p>
				<a href=#>Save</a>
				<a href=#>Delete</a>
			</div>
		@endif

		@if( isset($pupil))
			<div class="search_details">
				<form method="POST" action="/pupil/{{$pupil->id}}">
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$pupil->id}}</p>
					<textarea name="name">{{$pupil->name}}</textarea>
					<p>User ID: {{$pupil->user_id}}</p>
					<p>Classroom: {{$pupil->classroom_id}}</p>
					<button type="submit">Save</button>
				</form>
			</div>
			<div id="mainContainerTitle">
				<h1>{{$pupil->name}}'s Files</h1>
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
			<div id="mainContainerTitle">
				<h1>{{$pupil->name}}'s Parents</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($parents as $caregiver)
			    	<a class="mainContainerFileTitle" href="#">
						<div class="mainContainerFile">
							{{ $caregiver->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif

		@if( isset($parent))
			<div class="search_details">
				<p>ID: {{$parent->id}}</p>
				<p>Name: {{$parent->name}}</p>
				<p>User ID: {{$parent->user_id}}</p>
				<a href=#>Save</a>
				<a href=#>Delete</a>
			</div>
			@foreach($children as $child)
				<p>Name: {{$child->name}}</p>
				<p>User ID: {{$child->user_id}}</p>
				<p>Classroom: {{$child->classroom_id}}</p>
			@endforeach
		@endif

		@if( isset($classroom))
			<div class="search_details">
				<p>ID: {{$classroom->id}}</p>
				<p>Name: {{$classroom->name}}</p>
				<a href=#>Save</a>
				<a href=#>Delete</a>
			</div>
			<div id="mainContainerTitle">
				<h1>{{$classroom->name}} Pupils</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($pupils as $pupil)
			    	<a class="mainContainerFileTitle" href="#">
						<div class="mainContainerFile">
							{{ $pupil->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
			<div id="mainContainerTitle">
				<h1>{{$classroom->name}} Teachers</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($teachers as $teacher)
			    	<a class="mainContainerFileTitle" href="#">
						<div class="mainContainerFile">
							{{ $teacher->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif

@stop

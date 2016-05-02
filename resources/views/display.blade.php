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
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$teacher->id}}</p>
					<p>Name: <textarea name="name">{{$teacher->name}}</textarea></p>
					<p>User ID: {{$teacher->user_id}}</p>
					<p>Classroom: <textarea name="classroom_id">{{$teacher->classroom_id}}</textarea></p>
					<button class="search_button" type="submit">Save</button>
				</form>
				<form method="POST" action="/delete/teacher/{{$teacher->id}}" onsubmit="return confirm('Do you really want to delete this teacher?');">
					{{ method_field('DELETE')}}
					{{ csrf_field() }}
					<button class="search_button" type="submit">Delete</button>
				</form>
			</div>
			<div id="mainContainerTitle">
				<h1>{{$teacher->name}}'s Classroom</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($classrooms as $class)
			    	<a class="mainContainerFileTitle" href="/search/classroom/{{ $class->id }}">
						<div class="mainContainerFile">
							{{ $class->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif

		@if( isset($admin))
			<div class="search_details">
				<form method="POST" action="/admin/{{$admin->id}}">
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$admin->id}}</p>
					<p>Name: <textarea name="name">{{$admin->name}}</textarea></p>
					<p>User ID: {{$admin->user_id}}</p>
					<button class="search_button" type="submit">Save</button>
				</form>
				<form method="POST" action="/delete/admin/{{$admin->id}}" onsubmit="return confirm('Do you really want to delete this admin?');">
					{{ method_field('DELETE')}}
					{{ csrf_field() }}
					<button class="search_button" type="submit">Delete</button>
				</form>
			</div>
		@endif

		@if( isset($pupil))
			<div class="search_details">
				<form method="POST" action="/pupil/{{$pupil->id}}">
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$pupil->id}}</p>
					<p>
						<label for="name">Name:</label>
						<textarea name="name">{{$pupil->name}}</textarea>
					</p>
					<p>User ID: {{$pupil->user_id}}</p>

					<p>Classroom: 
						<select name="classroom" value="{{ old('classroom') }}">
				        	@foreach($classrooms as $class)
				        		<option value="{{ $class->id }}">{{ $class->name }}</option>
				        	@endforeach
				        </select>
					</p>
					<button class="search_button" type="submit">Save</button>
				</form>
				<form method="POST" action="/delete/pupil/{{$pupil->id}}" onsubmit="return confirm('Do you really want to delete this pupil?');">
					{{ method_field('DELETE')}}
					{{ csrf_field() }}
					<button class="search_button" type="submit">Delete</button>
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
			    	<a class="mainContainerFileTitle" href="/search/parent/{{ $caregiver->id }}">
						<div class="mainContainerFile">
							{{ $caregiver->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
			<div id="mainContainerTitle">
				<h1>{{$pupil->name}}'s Classroom</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($classrooms as $class)
			    	<a class="mainContainerFileTitle" href="/search/classroom/{{ $class->id }}">
						<div class="mainContainerFile">
							{{ $class->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif

		@if( isset($parent))
			<div class="search_details">
				<form method="POST" action="/parent/{{$parent->id}}">
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$parent->id}}</p>
					<p>Name: <textarea name="name">{{$parent->name}}</textarea></p>
					<p>User ID: {{$parent->user_id}}</p>
					<button class="search_button" type="submit">Save</button>
				</form>
				<form method="POST" action="/delete/parent/{{$parent->id}}" onsubmit="return confirm('Do you really want to delete this parent?');">
					{{ method_field('DELETE')}}
					{{ csrf_field() }}
					<button class="search_button" type="submit">Delete</button>
				</form>
			</div>
			<div id="mainContainerTitle">
				<h1>{{$parent->name}} Children</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($children as $child)
			    	<a class="mainContainerFileTitle" href="/search/pupil/{{ $child->id }}">
						<div class="mainContainerFile">
							{{ $child->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif

		@if( isset($classroom))
			<div class="search_details">
				<form method="POST" action="/classroom/{{$classroom->id}}">
					{{ method_field('PATCH')}}
					{{ csrf_field() }}
					<p>ID: {{$classroom->id}}</p>
					<p>Classroom: <textarea name="name">{{$classroom->name}}</textarea></p>
					<button class="search_button" type="submit">Save</button>
				</form>
				<form method="POST" action="/delete/classroom/{{$classroom->id}}" onsubmit="return confirm('Do you really want to delete this classroom?');">
					{{ method_field('DELETE')}}
					{{ csrf_field() }}
					<button class="search_button" type="submit">Delete</button>
				</form>
			</div>
			<div id="mainContainerTitle">
				<h1>{{$classroom->name}} Pupils</h1>
			</div>
			<ul id="mainContainerFiles">
			    @foreach($pupils as $pupil)
			    	<a class="mainContainerFileTitle" href="/search/pupil/{{ $pupil->id }}">
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
			    	<a class="mainContainerFileTitle" href="/search/teacher/{{ $teacher->id }}">
						<div class="mainContainerFile">
							{{ $teacher->name }} 
						</div>
					</a>
			    @endforeach
			</ul>
		@endif
@stop

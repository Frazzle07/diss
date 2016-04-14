@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Search Results</h1>
		</div>

		@if( isset($pupils))
		    @if (count($pupils) === 0)
				<p>Nothing Found</p>
			@elseif (count($pupils) >= 1)
				<ul id="mainContainerFiles">
				    @foreach($pupils as $pupil)
				    	<a class="mainContainerFileTitle" href="pupil/{{$pupil->id}}">
							<div class="mainContainerFile">
								{{ $pupil->name }} 
							</div>
						</a>
				    @endforeach
				</ul>
			@endif
		@endif
		
		@if( isset($parents))
			@if (count($parents) === 0)
				<p>Nothing Found</p>
			@elseif (count($parents) >= 1)
				<ul id="mainContainerFiles">
				    @foreach($parents as $parent)
				    	<a class="mainContainerFileTitle" href="parent/{{ $parent->id }}">
							<div class="mainContainerFile">
								{{ $parent->name }} 
							</div>
						</a>
				    @endforeach
				</ul>
			@endif
		@endif

		@if( isset($teachers))
			@if (count($teachers) === 0)
				<p>Nothing Found</p>
			@elseif (count($teachers) >= 1)
				<ul id="mainContainerFiles">
				    @foreach($teachers as $teacher)
				    	<a class="mainContainerFileTitle" href="teacher/{{ $teacher->id }}">
							<div class="mainContainerFile">
								{{ $teacher->name }} 
							</div>
						</a>
				    @endforeach
			    </ul>
			@endif
		@endif

	</main>
</div>

@stop
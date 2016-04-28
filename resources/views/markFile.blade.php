@extends('layout')

@section('content')

<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Send "{{$mark->name}}" to Be Marked</h1>
		</div>



		<form method="POST" action="addmarkfile/{{ $mark->id }}">
			{!! csrf_field() !!}
			<div>
		        Teacher: <select name="teacher">
		        	@foreach($teachers as $teacher)
		        		<option value="{{ $teacher->user_id }}">{{ $teacher->name }}</option>
		        	@endforeach
		        </select>
		    </div>
		    <div>
			    Comments: <input type="text" name="comments">
		    </div>
		    <div>
		        <button type="submit">Add</button>
		    </div>
		    <input type="hidden" name="fileid" value="{{$mark->id}}"></input>
		</form>
@stop
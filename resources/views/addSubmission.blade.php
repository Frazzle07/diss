@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Create a New Submission</h1>
		</div>


		<form method="POST" action="addsubmission">
			{!! csrf_field() !!}
		    <div>
			    Name: <input type="text" name="name">
		    </div>
		    <div>
			    Date: (YYYY-MM-DD)<input type="date" name="due_date">
		    </div>
		    <div>
		        <button type="submit">Add</button>
		    </div>
		</form>

		@if (count($errors))
			<ul>
				@foreach ($errors->all() as $error)
				<li>
					{{$error}}
				</li>
				@endforeach
			</ul>
		@endif



@stop
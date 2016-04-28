@extends('layout')

@section('content')

<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Send File to Be Marked</h1>
		</div>

		@{{$mark}}

		@if (count($mark))
			<p>Yes</p>
		@else
			<p>No</p>
		@endif

@stop
@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Below Are Your Pupils</h1>
		</div>

		<pupils list="{{ $pupils }}"></pupils>

		<template id="pupils-template">
			<input id="headerSearchInput" v-model="fileSearch" type="text" placeholder="Search">
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

		<div id="mainContainerTitle">
			<h1>Below Are Currently Active Submissions</h1>
		</div>

		<a class="mainContainerFileDelete" href="pastsubmissions/{{Auth::user()->id}}">Past Submissions</a>

		<ul id="mainContainerFiles">
			<ul id="mainContainerFiles">
				@if (count($submissions))
					@foreach($submissions as $submission)
						<div id="fileMark">
							<a class="mainContainerFileTitle" href="submission/{{ $submission->id }}">
								<div class="mainContainerFile">
									{{ $submission->title }} 
									<br>
									Due: {{ $submission->due_date->format('d/m/Y') }} 
								</div>
							</a>
						</div>
					@endforeach
					<?php echo $submissions->appends(Input::except('page'))->render(); ?>
				@else
				<p>No Submission Are Currently Active</p>
				@endif
			</ul>
		</ul>
	</main>

@stop
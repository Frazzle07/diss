@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Past Submissions</h1>
		</div>

		<submissions list="{{ $submissions }}"></submissions>

		<template id="submissions-template">
			<input id="headerSearchInput" v-model="fileSearch" type="text" placeholder="Search">
			<ul id="mainContainerFiles">
				<li v-for="submission in list | filterBy fileSearch in 'title' | orderBy 'title'">
					<a class="mainContainerFileTitle" href="/submission/@{{ submission.id }}">
						<div class="mainContainerFile">
							@{{ submission.title | truncate '20' }} 
							<br>	
							@{{ submission.due_date | truncate '20' }} 	
						</div>
					</a>
				</li>
			</ul>
		</template>
	</main>

@stop
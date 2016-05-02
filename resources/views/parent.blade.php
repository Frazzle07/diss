@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Below Are Your Children</h1>
		</div>

		<children list="{{ $children }}"></children>

		<template id="children-template">
			<input id="headerSearchInput" v-model="fileSearch" type="text" placeholder="Search">
			<ul id="mainContainerFiles">
				<li v-for="child in list | filterBy fileSearch in 'name' | orderBy 'name'">
					<a class="mainContainerFileTitle" href="pupil/@{{ child.user_id }}">
						<div class="mainContainerFile">
							@{{ child.name | truncate '20' }} 	
						</div>
					</a>
				</li>
			</ul>
		</template>
	</main>
</div>

@stop
@extends('layout')

@section('content')


<header id="header">
		<div id="headerLeft">
			<div id="headerLogo"></div>
			<div id="headerSearch">
				<input id="headerSearchButton" type="submit" name="headerSearchButton" >
				<input id="headerSearchInput" type="text" name="headerSearchInput" v-model="mainSearch" placeholder="Search…" >
			</div>
		</div>	
		<div id="headerRight">
			<a href="{{ URL::to('logout') }}">Logout</a>
		</div>
</header>
<div id="wrapper">
	<aside id="sideContainer">
		
	</aside>
	<main id="mainContainer">
		
		@if (Auth::check())	
			<h1>Hello {{ Auth::user()->name }} - {{ Auth::user()->id }}</h1>
		@endif

		<h2>Below Are Your Students</h2>

		<pupils list="{{ $pupils }}"></pupils>

		<template id="pupils-template">
			<input id="mainContainerInput" v-model="fileSearch" type="text"></input>
			<ul id="mainContainerFiles">
					<li class="mainContainerFile" v-for="pupil in list | filterBy fileSearch in 'name' | orderBy 'name'">
						<a href="pupil/@{{ pupil.user_id }}">
							@{{ pupil.name | truncate '20' }} 
						</a>
					</li>
			</ul>
		</template>
	</main>
</div>

@stop
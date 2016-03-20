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
		<files list="{{ $files }}"></files>

		<template id="files-template">
			@if (Auth::check())
				
				<h1>Files for this {{ Auth::user()->name }} - {{ Auth::user()->id }}</h1>
			@else
				<h1>Files for this user</h1>
			@endif
			<input id="mainContainerInput" v-model="fileSearch" type="text"></input>
			<ul id="mainContainerFiles">
					<li class="mainContainerFile" v-for="file in list | filterBy fileSearch in 'name' | orderBy 'name'">
						<a href="/download/@{{ file.id }}">
							@{{ file.name | truncate '20' }} 
						</a>
					</li>
			</ul>
		</template>
	</main>
</div>

@stop
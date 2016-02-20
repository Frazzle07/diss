@extends('layout')

@section('content')


<header id="header">
		<div id="headerLeft">
			<div id="headerLogo"></div>
			<div id="headerSearch">
				<input id="headerSearchButton" type="submit" name="headerSearchButton" >
				<input id="headerSearchInput" type="text" name="headerSearchInput" v-model="search" placeholder="Search…" >
			</div>
		</div>	
		<div id="headerRight">My Account</div>
</header>
<div id="wrapper">
	<aside id="sideContainer">
		
	</aside>
	<main id="mainContainer">
		
		<files list="{{ $files }}"></files>

		<template id="files-template">
			@if (Auth::check())
				
				<h1>Files for this {{ Auth::user()->name }}</h1>
			@else
				<h1>Files for this user</h1>
			@endif
			<input id="mainContainerInput" v-model="fileSearch" type="text"></input>
			<ul id="mainContainerFiles">
					<li class="mainContainerFile" v-for="file in list | filterBy fileSearch in 'name' | orderBy 'name'">
						@{{ file.name + ' - ' + file.size }}
					</li>
			</ul>
		</template>
	</main>
</div>

@stop
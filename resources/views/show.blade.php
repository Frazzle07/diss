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
		<h1> {{ $file->name }}
	</main>
</div>

@stop
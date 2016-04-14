@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Choose Your Operation Below</h1>
		</div>

		<div class="mainContainerButtons">
			<button class="search_button" @click="set_show('puShow')">Search Pupils</button>
			<button class="search_button" @click="set_show('tShow')">Search Teacher</button>
			<button class="search_button" @click="set_show('aShow')">Search Admins</button>
			<button class="search_button" @click="set_show('paShow')">Search Parents</button>
			<button class="search_button" @click="set_show('cShow')">Search Classroom</button>
			<button class="search_button" @click="set_show('addShow')">Add User</button>
		</div>


		<div v-cloak class="mainContainerSearch" v-show="show == 'puShow'" transition="fade">
			<h2>Pupil Search</h2>
			{{ Form::open(array('route' => 'pupil.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'tShow'" transition="fade">
			<h2>Teacher Search</h2>
			{{ Form::open(array('route' => 'teacher.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'aShow'" transition="fade">
			<h2>Admin Search</h2>
			{{ Form::open(array('route' => 'admin.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'paShow'" transition="fade">
			<h2>Parent Search</h2>
			{{ Form::open(array('route' => 'parent.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'cShow'" transition="fade">
			<h2>Classroom Search</h2>
			{{ Form::open(array('route' => 'classroom.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'addShow'" transition="fade">
			<h2>Add New User</h2>
			<form method="POST" action="/auth/register">
			    {!! csrf_field() !!}

			    <div>
			        Name
			        <input type="text" name="name" value="{{ old('name') }}">
			    </div>

			    <div>
			        Email
			        <input type="email" name="email" value="{{ old('email') }}">
			    </div>

			    <div>
			        Password
			        <input type="password" name="password">
			    </div>

			    <div>
			        Confirm Password
			        <input type="password" name="password_confirmation">
			    </div>

			    <div>
			        <button type="submit">Register</button>
			    </div>
			</form>
		</div>

	</main>
</div>

@stop
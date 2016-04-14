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
			<!--  -->
		</div>

		<div v-cloak class="mainContainerSearch" v-show="show == 'paShow'" transition="fade">
			<h2>Parent Search</h2>
			{{ Form::open(array('route' => 'parent.search')) }}
		    {{ Form::text('search', null) }}
			{{ Form::submit('Search') }}
			{{ Form::close() }}
		</div>

			
		</template>
	</main>
</div>

@stop
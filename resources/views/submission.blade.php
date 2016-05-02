@extends('layout')

@section('content')

	<main id="mainContainer">

		<div id="mainContainerTitle">
			<h1>Below Are The Submitted Files For Submission</h1>
		</div>

		<ul id="mainContainerFiles">
			@if (count($toBeMarked))
				@foreach($toBeMarked as $markFile)
				<div id="fileMark">
					<a class="mainContainerFileTitle" href="/download/{{ $markFile->file_id }}">
						<div class="mainContainerFile">
							{{ $markFile->filename }} 
							@if ($markFile->late == 1)
								<br>
								<p class="late">LATE</p>
							@endif
						</div>
					</a>
					<form method="post" action="/setMark/{{$markFile->file_id}}">
						{{ method_field('PATCH')}}
						{{ csrf_field() }}
						<div>
							<input type="text" name="mark" placeholder="Mark..."></input>
							<input type="hidden" name="marked" value="1"></input>
							<input type="submit" name="submit" value="Submit"></input>
						</div>
					</form>
				</div>
				@endforeach
				<?php echo $toBeMarked->appends(Input::except('page'))->render(); ?>
			@else
				<p>No Files Have Been Submitted</p>
			@endif
		</ul>

		<div id="mainContainerTitle">
			<h1>Already Marked Files</h1>
		</div>

		<ul id="mainContainerFiles">
			@if (count($marked))
				@foreach($marked as $markFile)
				<div id="fileMark">
					<a class="mainContainerFileTitle" href="/download/{{ $markFile->file_id }}">
						<div class="mainContainerFile">
							{{ $markFile->filename }} 
							@if ($markFile->late == 1)
								<br>
								<p class="late">LATE</p>
							@endif
							<div class="mainContainerFileMark">
								{{ $markFile->mark }} 
							</div>
						</div>
					</a>
					<form method="post" action="/setMark/{{$markFile->file_id}}">
						{{ method_field('PATCH')}}
						{{ csrf_field() }}
						<div>
							<input type="text" name="mark" placeholder="Mark..."></input>
							<input type="hidden" name="marked" value="1"></input>
							<input type="submit" name="submit" value="Submit"></input>
						</div>
					</form>
				</div>
				@endforeach
				<?php echo $marked->appends(Input::except('page'))->render(); ?>
			@else
				<p>No Files Have Been Marked</p>
			@endif
		</ul>
	</main>

@stop
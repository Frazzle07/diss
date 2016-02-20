@extends('layout')

@section('content')
	<div id="loginForm">
		<h1>Sign In</h1>
		<div id="loginUsername">
			<input type="text" id="loginUsernameInput">
		</div>
		<div id="loginPassword">
			<input type="password" id="loginPasswordInput">
		</div>
		<div id="loginSubmit">
			<input type="submit" id="loginSubmitButton">
		</div>
	</div>
@stop
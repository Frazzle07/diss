<!DOCTYPE html>
<html lang="eng">
    <head>
    	<meta charset="UFF-8">
        <title>Filestore - Home</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.js"></script>
    </head>
    <body>
    	<div id="app">
        	@yield('content')
        	<script src="/js/vendor.js"></script>
    		<script src="/js/app.js"></script>
        </div>
    </body>
</html>
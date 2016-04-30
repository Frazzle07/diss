<!DOCTYPE html>
<html lang="eng">
    <head>
            	
        <meta charset="UFF-8">
        <title>Filestore - Home</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.js"></script>
    </head>
    <body>
    	<div id="app">
            @if (\Session::has("flash_message"))
                <div class="Alert Alert--{{ ucwords(\Session::get('flash_message_type')) }}">{{ \Session::get("flash_message") }}</div>
            @endif
            @if (count($errors))
                 <div class="Alert Alert--Fail">There Were Errors With Your Request</div>
            @endif
            <header id="header">
                    <div id="headerLogo"><a href="/">Filestore</a></div>
                    <div id="headerSearch">
                        <input id="headerSearchInput" v-model="fileSearch" type="text" placeholder="Search">
                    </div>
                <div id="headerRight">
                    @if (Auth::check())
                        <button class="dropbtn">{{ Auth::user()->name }}</button>
                        <div class="dropdown-content">
                            <a href="/logout">Logout</a>
                        </div>
                    @endif
                </div>
            </header>
            <div id="wrapper">
                	@yield('content')
                	<script src="/js/vendor.js"></script>
            		<script src="/js/app.js"></script>
                </main>
            </div>
        </div>
    </body>
</html>

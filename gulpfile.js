var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

require('laravel-elixir-postcss');
 
elixir(function(mix) {
  
  //app.css, *.css, **/*.css     
  mix.postcss('app.css')
  	.version('public/css/app.css');
  mix.scripts([
  	'vendor/vue-resource.min.js'
  	], 'public/js/vendor.js')
});

const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir(mix => {

    mix.sass('app.scss');

    mix.browserify('resources/assets/js/libs.js', 'resources/assets/js_mixed', './')
        .browserify('resources/assets/js/app.js', 'resources/assets/js_mixed', './');

    mix.scripts([
        'resources/assets/js_mixed/libs.js',
        'node_modules/spin.js/spin.min.js',
        'node_modules/spin.js/jquery.spin.js',
        'resources/assets/js_mixed/app.js'
    ], 'public/js/app.js', './');
});
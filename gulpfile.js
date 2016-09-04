const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir(mix => {

    mix
        .copy(
            'node_modules/spin.js/spin.min.js',
            'resources/assets/js/spin'
        )
        .copy(
            'node_modules/spin.js/jquery.spin.js',
            'resources/assets/js/spin'
        )
        .sass('app.scss')
        .scripts([
            'spin/spin.min.js',
            'spin/jquery.spin.js'
        ])
        .browserify('libs.js')
        .browserify('app.js');
});

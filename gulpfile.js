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

var project_root = '../../../';

elixir(function (mix) {
    mix.sass([
        project_root + 'resources/assets/sass/stick-it.scss'
    ], 'resources/assets/build/css/compiled-sass.css');

    mix.less([
        project_root + 'bower_components/mjolnic-bootstrap-colorpicker/src/less/colorpicker.less'
    ], 'resources/assets/build/css/compiled-less.css');

    mix.styles([
        '../build/css/compiled-sass.css',
        '../build/css/compiled-less.css'
    ], 'public/css/stick.it.css');

    mix.scripts([
        project_root + 'bower_components/tether/dist/js/tether.js',
        project_root + 'bower_components/jquery/dist/jquery.js',
        project_root + 'bower_components/bootstrap/dist/js/bootstrap.js',
        project_root + 'bower_components/sweetalert/dist/sweetalert-dev.js',
        project_root + 'bower_components/vue/dist/vue.js',
        project_root + 'bower_components/vue-resource/dist/vue-resource.js',
        project_root + 'bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
        project_root + 'resources/assets/js/stick-it.js'
    ], 'public/js/stick.it.js');

    mix.scripts([
        project_root + 'resources/assets/js/modules/note-manager-app.js'
    ], 'public/js/stick.it.note-manager-app.js');

    mix.scripts([
        project_root + 'resources/assets/js/modules/note-trash-app.js'
    ], 'public/js/stick.it.note-trash-app.js');

    mix.version([
        'css/stick.it.css',
        'js/stick.it.js',
        // Vue Modules
        'js/stick.it.note-manager-app.js',
        'js/stick.it.note-trash-app.js'

    ], 'public/');

    mix.copy('bower_components/font-awesome/fonts', 'public/fonts');

    mix.copy('bower_components/mjolnic-bootstrap-colorpicker/dist/img', 'public/img');

    mix.copy('resources/assets/img', 'public/img');
});

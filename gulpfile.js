var elixir = require('laravel-elixir');

//elixir.config.sourcemaps = false;

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

elixir(function(mix) {
    var vendor_dir = 'bower_components/';

    mix.less([
        '../../../bower_components/bootstrap/less/bootstrap.less',
        '../../../bower_components/bootstrap-rtl/less/bootstrap-flipped.less',
        '../../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
        '../../../bower_components/font-awesome/less/font-awesome.less',
        '../../../bower_components/admin-lte-rtl/dist/css/AdminLTE.css',
        '../../../bower_components/admin-lte-rtl/dist/css/AdminLTE-rtl.css',
        '../../../bower_components/admin-lte-rtl/plugins/iCheck/square/blue.css',
        '../../../bower_components/admin-lte-rtl/dist/css/skins/_all-skins.min.css',
        '../../../bower_components/admin-lte-rtl/dist/css/skins/_all-skins-rtl.min.css',
        '../gal/css/block.css',
        '../gal/gallery/css/prettyPhoto.css',
        'app.less'
    ], 'public/assets/css/app.css');


    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.min.js',
        '../../../bower_components/jquery-ui/jquery-ui.min.js',
        '../../../bower_components/bootstrap/dist/js/bootstrap.js',
        '../../../bower_components/admin-lte-rtl/dist/js/app.js',
        '../../../bower_components/admin-lte-rtl/dist/js/demo.js',
        '../../../bower_components/admin-lte-rtl/plugins/iCheck/icheck.min.js',
        '../../../bower_components/moment/min/moment.min.js',
        '../../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        '../gal/js/respond.min.js',
        '../gal/gallery/js/jquery.prettyPhoto.js',
        'script.js',
        'app.js'
    ], 'public/assets/js/app.js');

    /* Version styles and scripts*/
    mix.version([
        'assets/css/app.css',
        'assets/js/app.js',
    ]);

    mix.copy('bower_components/font-awesome/fonts', 'public/build/assets/fonts');
    mix.copy('bower_components/bootstrap/fonts', 'public/build/assets/fonts');
    mix.copy('bower_components/admin-lte-rtl/plugins/iCheck/square/blue.png','public/build/assets/img');
    mix.copy('resources/assets/img', 'public/build/assets/img');
    mix.copy('resources/assets/js/jquery-file-upload', 'public/build/assets/js/jquery-file-upload');

});

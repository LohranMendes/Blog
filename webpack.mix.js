const mix = require('laravel-mix');

mix.browserSync({
    proxy: 'http://10.100.214.177:8000',
    open: false,
});

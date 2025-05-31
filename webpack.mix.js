const mix = require('laravel-mix');

// Procesar styles.css desde resources/css y copiarlo a public/css
mix.styles('resources/css/styles.css', 'public/css/styles.css');

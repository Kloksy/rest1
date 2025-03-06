import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', 
                'resources/js/app.js',
                'resources/css/app.css', 
                'node_modules/admin-lte/dist/css/adminlte.min.css',
                'node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css',
                'node_modules/admin-lte/dist/js/adminlte.min.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            {
                find: /^~(.*)$/,
                replacement: '$1',
            },
        ],
    },
});

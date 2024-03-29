import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build:{
        minify:false,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js', 
                'resources/js/nav.js',
                'resources/js/editor.js',
                'resources/js/editorView.js',
            ],
            refresh: true,
        })
    ],
});

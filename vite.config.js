import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
    plugins: [
        laravel({
            input: [ 'resources/scss/app.scss','resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        https:
            true,
        hmr: {
            host: 'localhost'
        }
    }
});

import {defineConfig} from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue"
export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/main.js',
            'resources/js/app.js',
        ]),
        vue()
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    }
});

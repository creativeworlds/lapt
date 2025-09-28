import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/style.scss', 'resources/main.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                entryFileNames: '_vite/main.js',
                assetFileNames: '_vite/style.css',
                chunkFileNames: `assets/[name].[ext]`,
            }
        }
    }
});
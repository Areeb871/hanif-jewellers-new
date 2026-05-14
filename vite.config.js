import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'public/assets/css/custom.css',
                'public/assets/f_assets/css/style.css',
                'public/assets/js/custom/landing.js',
                'public/assets/js/custom/widgets.js',
                'public/assets/f_assets/js/style.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['bootstrap'],
                    custom: [
                        'public/assets/js/custom/landing.js',
                        'public/assets/js/custom/widgets.js'
                    ]
                }
            }
        },
        cssMinify: true,
        sourcemap: false,
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "resources/sass/_variables.scss";`
            }
        }
    }
});



import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "tailwindcss";

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: [
                "resources/views/landing/css/landing.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [tailwindcss()],
        },
    },
    server: {
        port: 8080
    }
}));

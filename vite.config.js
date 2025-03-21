import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "tailwindcss";

export default defineConfig({
  plugins: [
    laravel({
      input: ["public/css/tinped.css"],
      refresh: true,
    }),
  ],
  css: {
    postcss: {
      plugins: [tailwindcss()],
    },
  },
});

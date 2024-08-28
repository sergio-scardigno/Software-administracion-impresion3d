import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/all.js",
                "resources/js/costos.js",
                "resources/js/conversion-precios-ARS-USD.js",
                "resources/js/consulta-precios.js",
            ],
            refresh: true,
        }),
    ],
});

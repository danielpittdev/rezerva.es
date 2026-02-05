import { defineConfig } from "vite"
import laravel from "laravel-vite-plugin"
import tailwindcss from "@tailwindcss/vite"
import fs from "fs"

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/request-manager.js",
                "resources/js/calendario.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    define: {
        global: 'globalThis',
    },
    server: {
        host: "vitalic.local",
        port: 5190,
        strictPort: true,
        hmr: {
            host: "127.0.0.1",
            protocol: "ws",
        },
    },
})
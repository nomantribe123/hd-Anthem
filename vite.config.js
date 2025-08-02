import { defineConfig } from 'vite';
import { resolve } from 'path';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  build: {
    assetsDir: '',
    manifest: false,
    emptyOutDir: true,
    outDir: resolve(__dirname, 'dist'),
    sourcemap: true,
    rollupOptions: {
      input: {
        main: resolve('assets/js/app.js')
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
					if (assetInfo.name && assetInfo.name.endsWith('.css')) {
						return 'css/main.css';
					}
					return 'assets/[name][extname]';
				}
      }
    }
  },
  plugins: [
    tailwindcss()
  ]
});
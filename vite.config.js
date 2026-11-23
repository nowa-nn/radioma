import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig(({ command }) => ({
  base: process.env.VITE_BASE !== undefined ? process.env.VITE_BASE : (command === 'build' ? '/radioma/' : '/'),
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src')
    }
  }
}))

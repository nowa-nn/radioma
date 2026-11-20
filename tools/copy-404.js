import fs from 'node:fs'
import path from 'node:path'

const indexPath = path.resolve('dist', 'index.html')
const notFoundPath = path.resolve('dist', '404.html')

if (fs.existsSync(indexPath)) {
  fs.copyFileSync(indexPath, notFoundPath)
  console.log('Successfully created dist/404.html for GitHub Pages SPA routing.')
}

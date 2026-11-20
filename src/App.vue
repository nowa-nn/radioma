<template>
  <router-view />
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'

function applyScale() {
  const width = window.innerWidth || document.documentElement.clientWidth
  if (width >= 1024) {
    const baseWidth = 1536 // Эталон: 125% масштаб экрана Windows на FullHD (1920 / 1.25 = 1536)
    const zoom = width / baseWidth
    document.body.style.zoom = zoom
  } else {
    document.body.style.zoom = ''
  }
}

onMounted(() => {
  applyScale()
  window.addEventListener('resize', applyScale)
})

onUnmounted(() => {
  window.removeEventListener('resize', applyScale)
})
</script>

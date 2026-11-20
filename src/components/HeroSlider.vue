<template>
  <section 
    class="w-full relative overflow-hidden bg-slate-950 text-white"
    :class="isTransparent ? 'h-screen min-h-[640px]' : 'h-[calc(100vh-100px)] min-h-[560px]'"
    @mouseenter="stopAutoplay"
    @mouseleave="startAutoplay"
  >
    <!-- Фоновые изображения на всю ширину экрана с плавной сменой -->
    <transition name="fade">
      <div 
        :key="currentSlideItem.id" 
        class="absolute inset-0 w-full h-full"
      >
        <!-- Полноэкранная фотография -->
        <img 
          :src="currentSlideItem.image" 
          :alt="currentSlideItem.title"
          class="w-full h-full object-cover object-center"
        />

        <!-- Плавное затемнение на всю ширину экрана: слева глубокий темный тон для читаемости текста, справа фото видно -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/75 to-slate-950/25"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-slate-950/20"></div>
        <!-- Верхнее мягкое затемнение для прозрачного хедера -->
        <div v-if="isTransparent" class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950/40 pointer-events-none"></div>
      </div>
    </transition>

    <!-- Контент поверх затемненного изображения (без скобок в названиях, текст свободно копируется) -->
    <div 
      class="relative z-10 max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex flex-col justify-center"
      :class="isTransparent ? 'pt-24 sm:pt-28' : ''"
    >
      <div class="max-w-2xl space-y-5">
        <!-- Крупный заголовок слайда (на мобильных устройствах слайды 2 и 3 разбиты ровно на 3 строки) -->
        <h1 
          class="text-2xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight"
          v-html="currentSlideItem.titleHtml || currentSlideItem.title"
        ></h1>

        <!-- Лаконичный производственный текст -->
        <p class="text-base sm:text-lg text-slate-200 leading-relaxed font-normal max-w-xl">
          {{ currentSlideItem.description }}
        </p>

        <!-- Кнопка перехода к информации о направлении (текст "Подробнее", строго без стрелок) -->
        <div class="pt-3">
          <a 
            :href="currentSlideItem.link"
            class="inline-block bg-sky-600 hover:bg-sky-700 text-white text-sm font-medium px-6 py-3 rounded transition-colors"
          >
            Подробнее
          </a>
        </div>
      </div>

      <!-- Минималистичные аккуратные полоски-индикаторы слайдов снизу слева -->
      <div class="flex items-center gap-2.5 pt-10">
        <button 
          v-for="(_, idx) in slides" 
          :key="idx"
          type="button"
          class="h-1 rounded transition-all duration-300 cursor-pointer"
          :class="currentSlide === idx ? 'w-10 bg-white' : 'w-4 bg-white/40 hover:bg-white/70'"
          :aria-label="`Перейти к слайду ${idx + 1}`"
          @click="setSlide(idx)"
        ></button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  isTransparent: {
    type: Boolean,
    default: true
  }
})

const currentSlide = ref(0)
let timer = null
const baseUrl = import.meta.env.BASE_URL

// Названия слайдов строго БЕЗ скобок и аббревиатур
const slides = [
  {
    id: 'suds-ais',
    title: 'Оборудование систем управления судов',
    titleHtml: 'Оборудование систем управления судов',
    description: 'Береговые станции АИС, лоцманские комплексы и системы координации движения судов для обеспечения безопасности мореплавания в портовых водах и на фарватерах.',
    buttonText: 'Подробнее',
    link: '#suds-ais',
    image: `${baseUrl}images/ship-4.jpg`
  },
  {
    id: 'gmssb',
    title: 'Системы глобальной морской связи при бедствии',
    titleHtml: 'Системы глобальной <br class="sm:hidden" />морской связи при бедствии',
    description: 'Комплексные береговые и судовые технические решения для несения непрерывной радиовахты в морских районах А1, А2 и А3, включая акваторию СМП.',
    buttonText: 'Подробнее',
    link: '#gmssb',
    image: `${baseUrl}images/ship-unsplash-1.jpg`
  },
  {
    id: 'marine-radio',
    title: 'Радиостанции для морского и речного флота',
    titleHtml: 'Радиостанции для морского <br class="sm:hidden" />и речного флота',
    description: 'Стационарные, судовые и носимые радиостанции морского (УКВ/КВ) и речного диапазонов под зарегистрированными торговыми марками «РАДИОМА» и «САНТЕЙ МОБАЙЛ».',
    buttonText: 'Подробнее',
    link: '#marine-radio',
    image: `${baseUrl}images/ship-3.jpg`
  }
]

const currentSlideItem = computed(() => slides[currentSlide.value])

function nextSlide() {
  currentSlide.value = (currentSlide.value + 1) % slides.length
}

function prevSlide() {
  currentSlide.value = (currentSlide.value - 1 + slides.length) % slides.length
}

function setSlide(index) {
  currentSlide.value = index
}

function startAutoplay() {
  stopAutoplay()
  timer = setInterval(() => {
    nextSlide()
  }, 7000)
}

function stopAutoplay() {
  if (timer) {
    clearInterval(timer)
    timer = null
  }
}

onMounted(() => {
  startAutoplay()
})

onUnmounted(() => {
  stopAutoplay()
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.6s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
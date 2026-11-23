<template>
  <section 
    class="w-full relative overflow-hidden bg-[#05182e] text-white touch-pan-y"
    :class="isHalfHeight 
      ? 'h-[50vh] min-h-[380px] sm:min-h-[420px] lg:h-[50vh]' 
      : (isTransparent 
          ? 'h-screen min-h-[580px] h-[100dvh]' 
          : 'h-[calc(100vh-56px)] sm:h-[calc(100vh-64px)] h-[calc(100dvh-56px)] sm:h-[calc(100dvh-64px)] min-h-[540px]')"
    @mouseenter="stopAutoplay"
    @mouseleave="startAutoplay"
    @touchstart.passive="handleTouchStart"
    @touchmove.passive="handleTouchMove"
    @touchend="handleTouchEnd"
  >
    <!-- Фоновые изображения на всю ширину экрана с плавной одновременной сменой (без мерцания и задержек загрузки) -->
    <div 
      v-for="(slide, idx) in activeSlides" 
      :key="slide.id" 
      class="absolute inset-0 w-full h-full bg-[#05182e] transition-opacity duration-700 ease-in-out pointer-events-none"
      :class="currentSlide === idx ? 'opacity-100 z-0' : 'opacity-0 -z-10'"
    >
      <!-- Обертка фото: на первом слайде сдвинута вправо на десктопе, открывая радиоприемник и логотип «РАДИОМА» справа -->
      <div 
        :class="slide.imageWrapperClass || 'absolute inset-0 w-full h-full'"
        :style="slide.id === 'company-overview' ? {
          WebkitMaskImage: 'linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 15%, black 35%, black 100%)',
          maskImage: 'linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 15%, black 35%, black 100%)'
        } : {}"
      >
        <img 
          :src="slide.image" 
          :alt="slide.title"
          :class="slide.imageClass || 'w-full h-full object-cover object-center'"
          :loading="idx === 0 ? 'eager' : 'lazy'"
          :fetchpriority="idx === 0 ? 'high' : 'low'"
        />

        <!-- Дополнительный мягкий внутренний градиент слева у фото для абсолютной бесшовности (с глубоким синеватым морским оттенком) -->
        <div 
          v-if="slide.id === 'company-overview'" 
          class="absolute inset-y-0 left-0 w-48 sm:w-80 lg:w-96 bg-gradient-to-r from-[#05182e] via-[#05182e]/85 to-transparent pointer-events-none"
        ></div>
      </div>

      <!-- Плавное затемнение на десктопе: глубокий тон с насыщенным синевато-морским оттенком слева для идеального чтения текста -->
      <div class="hidden sm:block absolute inset-0 bg-gradient-to-r from-[#061c36] via-[#072444]/95 lg:via-[#082a4e]/70 to-transparent pointer-events-none"></div>
      <div class="hidden sm:block absolute inset-0 bg-gradient-to-t from-[#041426]/85 via-[#061c36]/35 to-[#072444]/30 pointer-events-none"></div>

      <!-- Сбалансированное мягкое затемнение в мобильной версии с синим морским оттенком -->
      <div class="sm:hidden absolute inset-0 bg-gradient-to-r from-[#061c36]/90 via-[#072444]/65 to-[#072444]/35 pointer-events-none"></div>
      <div class="sm:hidden absolute inset-0 bg-gradient-to-t from-[#041426]/90 via-[#061c36]/50 to-[#072444]/25 pointer-events-none"></div>

      <!-- Верхнее мягкое затемнение для прозрачного хедера -->
      <div v-if="isTransparent" class="absolute inset-0 bg-gradient-to-b from-[#041426]/85 via-transparent to-[#041426]/40 pointer-events-none"></div>
    </div>

    <!-- Контент поверх затемненного изображения (всегда слева с идеальной читаемостью) -->
    <div 
      class="relative z-10 max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex flex-col justify-center"
      :class="isHalfHeight ? 'pt-6 pb-4' : (isTransparent ? 'pt-24 sm:pt-28' : 'pt-10')"
    >
      <div 
        class="w-full max-w-none sm:max-w-2xl text-left"
        :class="isHalfHeight ? 'space-y-3' : 'space-y-5'"
      >
        <!-- Крупный заголовок слайда -->
        <h1 
          class="font-bold text-white tracking-tight leading-tight drop-shadow-[0_2px_4px_rgba(0,0,0,0.6)] sm:drop-shadow-none"
          :class="isHalfHeight ? 'text-xl sm:text-2xl lg:text-3xl' : 'text-[22px] min-[400px]:text-2xl sm:text-4xl lg:text-5xl'"
          v-html="currentSlideItem.titleHtml || currentSlideItem.title"
        ></h1>

        <!-- Лаконичный производственный текст -->
        <p 
          class="text-slate-100 sm:text-slate-200 leading-relaxed font-normal w-full max-w-none sm:max-w-xl drop-shadow-[0_1px_3px_rgba(0,0,0,0.6)] sm:drop-shadow-none"
          :class="isHalfHeight ? 'text-xs sm:text-sm line-clamp-3 sm:line-clamp-none' : 'text-base sm:text-lg'"
        >
          {{ currentSlideItem.description }}
        </p>

        <!-- Кнопка перехода к информации о направлении (текст "Подробнее" или "О компании") -->
        <div :class="isHalfHeight ? 'pt-1' : 'pt-3'">
          <a 
            v-if="currentSlideItem.link.startsWith('#')"
            :href="currentSlideItem.link"
            class="inline-block bg-[#0093CB] hover:bg-[#007EAF] text-white font-medium rounded transition-colors shadow-sm cursor-pointer"
            :class="isHalfHeight ? 'text-xs px-4 py-2' : 'text-sm px-6 py-3'"
            @click="handleLinkClick(currentSlideItem.link, $event)"
          >
            {{ currentSlideItem.buttonText || 'Подробнее' }}
          </a>
          <router-link 
            v-else
            :to="isClassic ? { path: currentSlideItem.link, query: { from: 'classic' } } : currentSlideItem.link"
            class="inline-block bg-[#0093CB] hover:bg-[#007EAF] text-white font-medium rounded transition-colors shadow-sm"
            :class="isHalfHeight ? 'text-xs px-4 py-2' : 'text-sm px-6 py-3'"
          >
            {{ currentSlideItem.buttonText || 'Подробнее' }}
          </router-link>
        </div>
      </div>

      <!-- Минималистичные аккуратные полоски-индикаторы слайдов снизу слева -->
      <div 
        class="flex items-center gap-2.5"
        :class="isHalfHeight ? 'pt-4' : 'pt-10'"
      >
        <button 
          v-for="(_, idx) in activeSlides" 
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
import { useRouter, useRoute } from 'vue-router'

const props = defineProps({
  isTransparent: {
    type: Boolean,
    default: true
  },
  isHalfHeight: {
    type: Boolean,
    default: false
  },
  variant: {
    type: String,
    default: ''
  }
})

const router = useRouter()
const route = useRoute()
const currentSlide = ref(0)
let timer = null
const baseUrl = import.meta.env.BASE_URL

const isClassic = computed(() => {
  return props.variant === 'classic' || route?.path?.startsWith('/classic') || (typeof window !== 'undefined' && window.location.pathname.includes('classic'))
})

// Базовые слайды для стандартного варианта
const defaultSlides = [
  {
    id: 'company-overview',
    title: 'РАДИОМА — радиосвязь и навигация с 1995 года',
    titleHtml: 'РАДИОМА — радиосвязь <br class="sm:hidden" />и навигация с 1995 года',
    description: 'Отечественный поставщик и признанный изготовитель ведомственных систем радиосвязи, оборудования безопасности мореплавания, комплексов ГМССБ и АИС для морского и речного флота России.',
    buttonText: 'О компании',
    link: '#about',
    image: `${baseUrl}images/pome/dscf2.jpg`,
    imageWrapperClass: 'absolute inset-y-0 right-0 w-full lg:w-[65%] xl:w-[60%]',
    imageClass: 'w-full h-full object-cover object-left'
  },
  {
    id: 'suds-ais',
    title: 'Оборудование систем управления судов',
    titleHtml: 'Оборудование систем управления судов',
    description: 'Береговые станции АИС, лоцманские комплексы и системы координации движения судов для обеспечения безопасности мореплавания в портовых водах и на фарватерах.',
    buttonText: 'Подробнее',
    link: '/directions/suds-ais',
    image: `${baseUrl}images/pome/dscf18.jpg`
  },
  {
    id: 'gmssb',
    title: 'Системы глобальной морской связи при бедствии',
    titleHtml: 'Системы глобальной <br class="sm:hidden" />морской связи при бедствии',
    description: 'Комплексные береговые и судовые технические решения для несения непрерывной радиовахты в морских районах А1, А2 и А3, включая акваторию СМП.',
    buttonText: 'Подробнее',
    link: '/directions/gmssb',
    image: `${baseUrl}images/pome/dscf05.jpg`
  },
  {
    id: 'marine-radio',
    title: 'Радиостанции для морского и речного флота',
    titleHtml: 'Радиостанции для морского <br class="sm:hidden" />и речного флота',
    description: 'Стационарные, судовые и носимые радиостанции морского (УКВ/КВ) и речного диапазонов под зарегистрированными торговыми марками «РАДИОМА» и «САНТЕЙ МОБАЙЛ».',
    buttonText: 'Подробнее',
    link: '/directions/marine-radio',
    image: `${baseUrl}images/pome/dscf1.jpg`
  },
  {
    id: 'land-radio',
    title: 'Сухопутная и ведомственная подвижная радиосвязь',
    titleHtml: 'Сухопутная и ведомственная <br class="sm:hidden" />подвижная радиосвязь',
    description: 'Профессиональное радиооборудование серий «РТ» и «САНТЕЙ» для оснащения транспортных средств, железнодорожного подвижного состава и диспетчерских служб.',
    buttonText: 'Подробнее',
    link: '/directions/land-radio',
    image: `${baseUrl}images/pome/dscf15.jpg`
  }
]

// Специализированные слайды для варианта classic (по утвержденным формулировкам)
const classicSlides = [
  {
    id: 'company-overview',
    title: 'РАДИОМА – профессиональная радиосвязь и навигация с 1995 года',
    titleHtml: 'РАДИОМА – профессиональная<br class="sm:hidden" /> радиосвязь и&nbsp;навигация<br /> <span class="whitespace-nowrap">с&nbsp;1995&nbsp;года</span>',
    description: 'Отечественный производитель и системный интегратор ведомственных комплексов и систем связи.',
    buttonText: 'О компании',
    link: '#about',
    image: `${baseUrl}images/pome/dscf2.jpg`,
    imageWrapperClass: 'absolute inset-y-0 right-0 w-full lg:w-[65%] xl:w-[60%]',
    imageClass: 'w-full h-full object-cover object-left'
  },
  {
    id: 'suds-ais',
    title: 'Оборудование систем управления движения судов',
    titleHtml: 'Оборудование систем <br class="sm:hidden" />управления движения судов',
    description: 'Береговое и судовое оборудование АИС, лоцманские комплексы и системы.',
    buttonText: 'Подробнее',
    link: '/directions/suds-ais',
    image: `${baseUrl}images/pome/dscf18.jpg`
  },
  {
    id: 'gmssb',
    title: 'Системы и оборудование глобальной морской связи при бедствии',
    titleHtml: 'Системы и оборудование глобальной <br class="sm:hidden" />морской связи при бедствии',
    description: 'Комплексные береговые и судовые технические решения для несения непрерывной радиовахты в морских районах А1, А2 и А3, включая акваторию СМП.',
    buttonText: 'Подробнее',
    link: '/directions/gmssb',
    image: `${baseUrl}images/pome/dscf05.jpg`
  },
  {
    id: 'marine-radio',
    title: 'Радиостанции для морского и речного флота',
    titleHtml: 'Радиостанции для морского <br class="sm:hidden" />и речного флота',
    description: 'Береговые и судовые радиостанции (ПВ-КВ/УКВ) и носимые трансиверы морского и речного диапазонов частот, антенны и блоки питания.',
    buttonText: 'Подробнее',
    link: '/directions/marine-radio',
    image: `${baseUrl}images/pome/dscf1.jpg`
  },
  {
    id: 'trunking',
    title: 'Профессиональные системы и оборудование подвижной радиосвязи (PMR/LMR)',
    titleHtml: 'Профессиональные системы и оборудование <br class="sm:hidden" />подвижной радиосвязи (PMR/LMR)',
    description: 'Современное оборудование радиосвязи и навигации, в том числе собственного производства на территории Российской Федерации.',
    buttonText: 'Подробнее',
    link: '/directions/trunking',
    image: `${baseUrl}images/pome/dscf15.jpg`
  }
]

const activeSlides = computed(() => isClassic.value ? classicSlides : defaultSlides)

const currentSlideItem = computed(() => activeSlides.value[currentSlide.value])

function handleLinkClick(hash, event) {
  if (event) {
    event.preventDefault()
  }
  const isCurrentHome = ['/', '', '/classic', '/compact', '/transparent'].includes(route.path)
  if (isCurrentHome) {
    const target = document.querySelector(hash)
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' })
      window.history.pushState(null, '', hash)
      return
    }
  }
  const basePath = isClassic.value ? '/classic' : '/'
  router.push({ path: basePath, hash })
}

function nextSlide() {
  currentSlide.value = (currentSlide.value + 1) % activeSlides.value.length
}

function prevSlide() {
  currentSlide.value = (currentSlide.value - 1 + activeSlides.value.length) % activeSlides.value.length
}

function setSlide(index) {
  currentSlide.value = index
}

// Функционал свайпа на мобайле
let touchStartX = 0
let touchStartY = 0
let touchEndX = 0
let touchEndY = 0

function handleTouchStart(e) {
  if (!e.touches || e.touches.length === 0) return
  touchStartX = e.touches[0].clientX
  touchStartY = e.touches[0].clientY
  touchEndX = touchStartX
  touchEndY = touchStartY
  stopAutoplay()
}

function handleTouchMove(e) {
  if (!e.touches || e.touches.length === 0) return
  touchEndX = e.touches[0].clientX
  touchEndY = e.touches[0].clientY
}

function handleTouchEnd() {
  const deltaX = touchEndX - touchStartX
  const deltaY = touchEndY - touchStartY
  const minSwipeDistance = 40 // минимальный порог свайпа в пикселях

  // Срабатывает только при преобладании горизонтального движения (чтобы не мешать вертикальному скроллу страницы)
  if (Math.abs(deltaX) > minSwipeDistance && Math.abs(deltaX) > Math.abs(deltaY) * 1.2) {
    if (deltaX < 0) {
      nextSlide()
    } else {
      prevSlide()
    }
  }
  startAutoplay()
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
  // Мгновенная предзагрузка всех слайдов в кэш браузера для мгновенного переключения без ожидания сети
  activeSlides.value.forEach(slide => {
    const img = new Image()
    img.src = slide.image
  })
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
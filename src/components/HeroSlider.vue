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

        <!-- Плавное затемнение: если слайд выровнен вправо, затемняем правый край, открывая радиооборудование «РАДИОМА» слева -->
        <div 
          v-if="currentSlideItem.align === 'right'"
          class="absolute inset-0 bg-gradient-to-l from-slate-950/95 via-slate-950/80 to-slate-950/25"
        ></div>
        <div 
          v-else
          class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/75 to-slate-950/25"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-slate-950/20"></div>
        <!-- Верхнее мягкое затемнение для прозрачного хедера -->
        <div v-if="isTransparent" class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950/40 pointer-events-none"></div>
      </div>
    </transition>

    <!-- Контент поверх затемненного изображения (без скобок в названиях, текст свободно копируется) -->
    <div 
      class="relative z-10 max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex flex-col justify-center"
      :class="isTransparent ? 'pt-24 sm:pt-28' : ''"
    >
      <div 
        class="max-w-2xl space-y-5"
        :class="currentSlideItem.align === 'right' ? 'sm:ml-auto text-left sm:text-right flex flex-col sm:items-end' : ''"
      >
        <!-- Крупный заголовок слайда (на мобильных устройствах слайды 2 и 3 разбиты ровно на 3 строки) -->
        <h1 
          class="text-2xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight"
          v-html="currentSlideItem.titleHtml || currentSlideItem.title"
        ></h1>

        <!-- Лаконичный производственный текст -->
        <p 
          class="text-base sm:text-lg text-slate-200 leading-relaxed font-normal max-w-xl"
          :class="currentSlideItem.align === 'right' ? 'sm:text-right' : ''"
        >
          {{ currentSlideItem.description }}
        </p>

        <!-- Кнопка перехода к информации о направлении (текст "Подробнее" или "О компании") -->
        <div 
          class="pt-3"
          :class="currentSlideItem.align === 'right' ? 'flex justify-start sm:justify-end' : ''"
        >
          <a 
            v-if="currentSlideItem.link.startsWith('#')"
            :href="currentSlideItem.link"
            class="inline-block bg-[#0093CB] hover:bg-[#007EAF] text-white text-sm font-medium px-6 py-3 rounded transition-colors shadow-sm cursor-pointer"
            @click="handleLinkClick(currentSlideItem.link, $event)"
          >
            {{ currentSlideItem.buttonText || 'Подробнее' }}
          </a>
          <router-link 
            v-else
            :to="currentSlideItem.link"
            class="inline-block bg-[#0093CB] hover:bg-[#007EAF] text-white text-sm font-medium px-6 py-3 rounded transition-colors shadow-sm"
          >
            {{ currentSlideItem.buttonText || 'Подробнее' }}
          </router-link>
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
import { useRouter, useRoute } from 'vue-router'

const props = defineProps({
  isTransparent: {
    type: Boolean,
    default: true
  }
})

const router = useRouter()
const route = useRoute()
const currentSlide = ref(0)
let timer = null
const baseUrl = import.meta.env.BASE_URL

// Слайды с реальными фотографиями оборудования и объектов ООО «Радиома»
const slides = [
  {
    id: 'company-overview',
    align: 'right',
    title: 'ООО «Радиома» — радиосвязь и навигация с 1995 года',
    titleHtml: 'ООО «Радиома» — радиосвязь <br class="sm:hidden" />и навигация с 1995 года',
    description: 'Отечественный поставщик и признанный изготовитель ведомственных систем радиосвязи, оборудования безопасности мореплавания, комплексов ГМССБ и АИС для морского и речного флота России.',
    buttonText: 'О компании',
    link: '#about',
    image: `${baseUrl}images/pome/dscf2.jpg`
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

const currentSlideItem = computed(() => slides[currentSlide.value])

function handleLinkClick(hash, event) {
  if (event) {
    event.preventDefault()
  }
  if (route.path === '/' || route.path === '') {
    const target = document.querySelector(hash)
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' })
      window.history.pushState(null, '', hash)
      return
    }
  }
  router.push({ path: '/', hash })
}

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
<template>
  <header class="fixed top-0 left-0 w-full z-40">
    <!-- Фон хедера для варианта Classic: всегда белый на десктопе; на мобайле белый при закрытом меню и черный при открытом меню -->
    <div 
      v-if="variant === 'classic'"
      class="absolute inset-0 transition-colors duration-200 pointer-events-none"
      :class="isMobileMenuOpen 
        ? 'bg-slate-950 border-b border-white/10 lg:bg-white lg:border-slate-200/80 lg:shadow-[0_4px_20px_rgba(0,0,0,0.12)]' 
        : 'bg-white shadow-[0_4px_20px_rgba(0,0,0,0.12)] border-b border-slate-200/80'"
    ></div>

    <!-- Фон хедера для стандартного варианта (shape): прозрачный сверху, залипающий белый при скролле -->
    <template v-else>
      <!-- Слой 1: Мягкий темный защитный градиент (плавно гаснет при скроле за 300мс) -->
      <div 
        class="absolute inset-0 bg-gradient-to-b from-slate-950/85 via-slate-950/45 to-transparent transition-opacity duration-300 pointer-events-none"
        :class="headerSolid ? 'opacity-0' : 'opacity-100'"
      ></div>

      <!-- Слой 2: Белый залипающий фон с тенью и нижней границей при скроле -->
      <div 
        class="absolute inset-0 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.12)] border-b border-slate-200/80 transition-opacity duration-300 pointer-events-none"
        :class="headerSolid ? 'opacity-100' : 'opacity-0'"
      ></div>
    </template>

    <!-- Единая верхняя панель (z-10): Логотип слева, Пункты меню по центру, Контакты справа -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div 
        class="flex items-center justify-between transition-all duration-200"
        :class="variant === 'classic' ? 'h-14 sm:h-16' : 'h-12 sm:h-14'"
      >
        <!-- Вариант 1 (Classic): Логотип без шейпа (всегда цветной на десктопе, а на мобайле меняется на белый при открытии меню) -->
        <router-link 
          v-if="variant === 'classic'"
          to="/" 
          class="relative flex items-center flex-shrink-0 h-7 sm:h-9 w-[105px] sm:w-[135px] z-20 group"
          aria-label="РАДИОМА"
        >
          <!-- Белый логотип: показывается на мобайле только когда открыто черное бургер-меню -->
          <img 
            :src="`${baseUrl}logo-photoroom-white.png`" 
            alt="РАДИОМА" 
            class="absolute inset-0 h-full w-auto object-contain object-left transition-opacity duration-200 pointer-events-none select-none"
            :class="isMobileMenuOpen ? 'block lg:hidden' : 'hidden'"
          />
          <!-- Цветной логотип: всегда на десктопе, и на мобайле при закрытом белом хедере -->
          <img 
            :src="`${baseUrl}logo-photoroom.png`" 
            alt="РАДИОМА" 
            class="absolute inset-0 h-full w-auto object-contain object-left transition-opacity duration-200 pointer-events-none select-none"
            :class="isMobileMenuOpen ? 'hidden lg:block' : 'block'"
          />
        </router-link>

        <!-- Вариант 2 (Shape): Логотип слева на отдельном свисающем синем шейпе -->
        <router-link 
          v-else
          to="/" 
          class="relative flex-shrink-0 h-12 sm:h-14 w-[8.625rem] sm:w-[11rem] lg:w-[12.75rem] z-20 group"
          aria-label="РАДИОМА"
        >
          <!-- Свисающий шейп: прикреплен к top-0, по высоте больше хедера, со скругленным низом -->
          <div 
            class="absolute top-0 left-0 w-full h-[4.875rem] sm:h-[6rem] lg:h-[6.75rem] bg-[#0093CB] rounded-b-xl sm:rounded-b-3xl shadow-[0_8px_20px_rgba(0,0,0,0.22)] border-x border-b border-[#007EAF] flex items-center justify-center px-3 sm:px-4.5 pt-1.5 sm:pt-2.5 pb-3 sm:pb-4 transition-all duration-200"
          >
            <!-- Читаемый белый логотип на фирменном голубом шейпе -->
            <img 
              :src="`${baseUrl}logo-white.png`" 
              alt="РАДИОМА" 
              class="w-full h-auto max-h-[3rem] sm:max-h-[3.875rem] lg:max-h-[4.5rem] object-contain pointer-events-none select-none"
            />
          </div>
        </router-link>

        <!-- Пункты меню по центру: 1. О компании, 2. Направления, 3. Новости, 4. Контакты (Десктоп) -->
        <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-sm sm:text-[15px] font-semibold transition-colors duration-300 px-4">
          <a 
            href="#about" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="(variant === 'classic' || headerSolid) ? 'text-slate-950 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5] drop-shadow'"
            @click="handleNavClick('#about', $event)"
          >
            О компании
          </a>
          <a 
            href="#directions" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="(variant === 'classic' || headerSolid) ? 'text-slate-950 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5] drop-shadow'"
            @click="handleNavClick('#directions', $event)"
          >
            Направления
          </a>
          <a 
            href="#news" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="(variant === 'classic' || headerSolid) ? 'text-slate-950 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5] drop-shadow'"
            @click="handleNavClick('#news', $event)"
          >
            Новости
          </a>
          <a 
            href="#contacts" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="(variant === 'classic' || headerSolid) ? 'text-slate-950 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5] drop-shadow'"
            @click="handleNavClick('#contacts', $event)"
          >
            Контакты
          </a>
        </nav>

        <!-- Контакты справа (Десктоп): Телефон с подписью 10:00 - 18:00 по МСК и кнопка «Связаться» -->
        <div class="hidden md:flex items-center gap-5 lg:gap-6 text-right flex-shrink-0">
          <div class="flex flex-col items-end whitespace-nowrap">
            <a 
              :href="`tel:${phoneRaw}`" 
              class="text-sm sm:text-base font-bold transition-colors whitespace-nowrap leading-tight"
              :class="(variant === 'classic' || headerSolid) ? 'text-slate-900 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5]'"
            >
              {{ phone }}
            </a>
            <span 
              class="text-[11px] font-medium leading-none mt-1 transition-colors"
              :class="(variant === 'classic' || headerSolid) ? 'text-slate-500' : 'text-slate-300'"
            >
              10:00 - 18:00 по МСК
            </span>
          </div>

          <!-- Кнопка «Связаться» -->
          <button 
            type="button" 
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-sm transition-all duration-200 cursor-pointer shadow-sm text-white bg-[#0093CB] hover:bg-[#007EAF] active:translate-y-px"
            @click="isContactModalOpen = true"
          >
            Связаться
          </button>
        </div>

        <!-- Мобильная правая часть: только бургер-кнопка -->
        <div class="flex items-center lg:hidden">
          <button 
            type="button" 
            class="flex items-center justify-center p-1 focus:outline-none transition-colors duration-200 cursor-pointer"
            :class="variant === 'classic' 
              ? (isMobileMenuOpen ? 'text-white hover:text-[#7FD3F5]' : 'text-slate-900 hover:text-[#0093CB]') 
              : (headerSolid ? 'text-slate-900 hover:text-[#0093CB]' : 'text-white hover:text-[#7FD3F5]')"
            :aria-expanded="isMobileMenuOpen"
            aria-label="Меню навигации"
            @click="isMobileMenuOpen = !isMobileMenuOpen"
          >
            <!-- Крестик при открытом меню -->
            <svg v-if="isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <!-- Иконка бургера (3 полоски) при закрытом меню -->
            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Мобильное выпадающее меню -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div 
        v-if="isMobileMenuOpen" 
        class="relative z-10 lg:hidden border-t px-5 py-4 space-y-4 transition-colors duration-200"
        :class="variant === 'classic' 
          ? 'bg-slate-950 border-white/10 text-white shadow-2xl' 
          : (headerSolid 
              ? 'bg-white border-slate-200 text-slate-900 shadow-xl' 
              : 'bg-slate-950/95 backdrop-blur-md border-white/10 text-white shadow-2xl')"
      >
        <nav 
          class="flex flex-col" 
          :class="(variant === 'classic' || !headerSolid) ? 'divide-y divide-white/10' : 'divide-y divide-slate-100'"
        >
          <a 
            href="#about" 
            class="py-2.5 text-base font-semibold transition-colors cursor-pointer"
            :class="(variant === 'classic' || !headerSolid) ? 'text-slate-100 hover:text-[#7FD3F5]' : 'text-slate-950 hover:text-[#0093CB]'"
            @click="handleNavClick('#about', $event)"
          >
            О компании
          </a>
          <a 
            href="#directions" 
            class="py-2.5 text-base font-semibold transition-colors cursor-pointer"
            :class="(variant === 'classic' || !headerSolid) ? 'text-slate-100 hover:text-[#7FD3F5]' : 'text-slate-950 hover:text-[#0093CB]'"
            @click="handleNavClick('#directions', $event)"
          >
            Направления
          </a>
          <a 
            href="#news" 
            class="py-2.5 text-base font-semibold transition-colors cursor-pointer"
            :class="(variant === 'classic' || !headerSolid) ? 'text-slate-100 hover:text-[#7FD3F5]' : 'text-slate-950 hover:text-[#0093CB]'"
            @click="handleNavClick('#news', $event)"
          >
            Новости
          </a>
          <a 
            href="#contacts" 
            class="py-2.5 text-base font-semibold transition-colors cursor-pointer"
            :class="(variant === 'classic' || !headerSolid) ? 'text-slate-100 hover:text-[#7FD3F5]' : 'text-slate-950 hover:text-[#0093CB]'"
            @click="handleNavClick('#contacts', $event)"
          >
            Контакты
          </a>
        </nav>

        <!-- Контактная информация внутри мобильного меню с подписью 10:00 - 18:00 по МСК -->
        <div 
          class="pt-3 border-t space-y-3 text-xs transition-colors duration-200"
          :class="(variant === 'classic' || !headerSolid) ? 'border-white/10 text-slate-300' : 'border-slate-200 text-slate-600'"
        >
          <div>
            <a 
              :href="`tel:${phoneRaw}`" 
              class="text-base font-bold transition-colors"
              :class="(variant === 'classic' || !headerSolid) ? 'text-white hover:text-[#7FD3F5]' : 'text-slate-900 hover:text-[#0093CB]'"
            >
              {{ phone }}
            </a>
            <div 
              class="text-[11px] font-medium transition-colors mt-0.5"
              :class="(variant === 'classic' || !headerSolid) ? 'text-slate-400' : 'text-slate-500'"
            >
              10:00 - 18:00 по МСК
            </div>
          </div>
          <div>
            <button 
              type="button" 
              class="w-full py-2.5 px-4 text-xs font-semibold rounded-sm text-white bg-[#0093CB] hover:bg-[#007EAF] transition-colors cursor-pointer text-center"
              @click="isMobileMenuOpen = false; isContactModalOpen = true"
            >
              Связаться
            </button>
          </div>
          <p class="text-[11px] text-slate-400 pt-1 leading-snug">
            ООО «Радиома» — оборудование радиосвязи и навигации с 1995 года
          </p>
        </div>
      </div>
    </transition>

    <!-- Попап обратной связи «Связаться» -->
    <FeedbackModal 
      v-model="isContactModalOpen" 
      title="Связаться с нами" 
      subject="Обращение через форму связи в шапке сайта" 
    />
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import FeedbackModal from './FeedbackModal.vue'

const props = defineProps({
  forceSolid: {
    type: Boolean,
    default: false
  },
  variant: {
    type: String,
    default: 'shape' // 'shape' (свисающий синий шейп) | 'classic' (без шейпа, смена цвета логотипа)
  }
})

const baseUrl = import.meta.env.BASE_URL
const router = useRouter()
const route = useRoute()
const isMobileMenuOpen = ref(false)
const isScrolled = ref(false)
const isContactModalOpen = ref(false)

const phone = '+7 (495) 725-6006'
const phoneRaw = '+74957256006'
const email = 'office@radioma.ru'

const headerSolid = computed(() => {
  const isTransparentRoute = route && ['/', '/transparent', '/classic', '/variant-3', '/standard'].includes(route.path)
  return props.forceSolid || !isTransparentRoute || isScrolled.value
})

function handleScroll() {
  isScrolled.value = window.scrollY > 20
}

function handleNavClick(hash, event) {
  if (event) {
    event.preventDefault()
  }
  isMobileMenuOpen.value = false

  const isCurrentPageOneOfHomes = ['/', '', '/classic', '/compact', '/variant-2', '/variant-3', '/transparent'].includes(route.path)
  if (isCurrentPageOneOfHomes) {
    const target = document.querySelector(hash)
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' })
      window.history.pushState(null, '', hash)
      return
    }
  }

  const basePath = route.path.startsWith('/classic') ? '/classic' : (route.path.startsWith('/compact') ? '/compact' : '/')
  router.push({ path: basePath, hash })
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true })
  handleScroll()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

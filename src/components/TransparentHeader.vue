<template>
  <header class="fixed top-0 left-0 w-full z-40">
    <!-- Слой 1: Мягкий темный защитный градиент (плавно гаснет при скроле за 300мс без стыков) -->
    <div 
      class="absolute inset-0 bg-gradient-to-b from-slate-950/85 via-slate-950/45 to-transparent transition-opacity duration-300 pointer-events-none"
      :class="headerSolid ? 'opacity-0' : 'opacity-100'"
    ></div>

    <!-- Слой 2: Белый залипающий фон с тенью и нижней границей (плавно проявляется при скроле и гаснет без задержек) -->
    <div 
      class="absolute inset-0 bg-white shadow-[0_4px_20px_rgba(0,0,0,0.12)] border-b border-slate-200/80 transition-opacity duration-300 pointer-events-none"
      :class="headerSolid ? 'opacity-100' : 'opacity-0'"
    ></div>

    <!-- Единая верхняя панель (z-10): Логотип со слоганом слева, Пункты меню по центру, Контакты справа -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between py-3 sm:py-3.5">
        <!-- Логотип и слоган слева -->
        <router-link to="/" class="flex items-center gap-3 flex-shrink-0">
          <div class="relative h-11 sm:h-13 w-[98px] sm:w-[116px] flex-shrink-0">
            <!-- Белый логотип на прозрачном фоне (без рамки) -->
            <img 
              :src="`${baseUrl}logo-white.png`" 
              alt="РАДИОМА" 
              class="absolute inset-0 h-full w-full object-contain object-left transition-opacity duration-300 pointer-events-none"
              :class="headerSolid ? 'opacity-0' : 'opacity-100'"
            />
            <!-- Цветной логотип на прозрачном фоне (без рамки, из logo-Photoroom) -->
            <img 
              :src="`${baseUrl}logo-transparent.png`" 
              alt="РАДИОМА" 
              class="absolute inset-0 h-full w-full object-contain object-left transition-opacity duration-300 pointer-events-none"
              :class="headerSolid ? 'opacity-100' : 'opacity-0'"
            />
          </div>

          <div class="hidden sm:block pt-0.5 transition-colors duration-300">
            <div 
              class="text-[11px] sm:text-xs uppercase tracking-wider font-semibold leading-tight transition-colors duration-300"
              :class="headerSolid ? 'text-slate-900' : 'text-white'"
            >
              Оборудование связи и навигации
            </div>
            <div 
              class="text-[10px] sm:text-[11px] leading-tight mt-0.5 transition-colors duration-300"
              :class="headerSolid ? 'text-slate-500' : 'text-slate-300'"
            >
              Поставка, интеграция и сервис
            </div>
          </div>
        </router-link>

        <!-- Пункты меню по центру между слоганом и номером телефона (Десктоп) -->
        <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-[13px] font-medium transition-colors duration-300 px-4">
          <a 
            href="#directions" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white/95 hover:text-sky-300 drop-shadow'"
            @click="handleNavClick('#directions', $event)"
          >
            Направления
          </a>
          <a 
            href="#news" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white/95 hover:text-sky-300 drop-shadow'"
            @click="handleNavClick('#news', $event)"
          >
            Новости
          </a>
          <a 
            href="#about" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white/95 hover:text-sky-300 drop-shadow'"
            @click="handleNavClick('#about', $event)"
          >
            О компании
          </a>
          <a 
            href="#contacts" 
            class="transition-colors whitespace-nowrap cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white/95 hover:text-sky-300 drop-shadow'"
            @click="handleNavClick('#contacts', $event)"
          >
            Контакты
          </a>
        </nav>

        <!-- Контакты справа (Десктоп): Телефон и электронная почта -->
        <div class="hidden md:flex items-center gap-6 lg:gap-8 text-right flex-shrink-0">
          <!-- Телефон -->
          <div class="flex flex-col whitespace-nowrap">
            <span 
              class="text-[10px] leading-none transition-colors duration-300"
              :class="headerSolid ? 'text-slate-400' : 'text-slate-300'"
            >
              Справочная служба:
            </span>
            <a 
              :href="`tel:${phoneRaw}`" 
              class="text-xs sm:text-sm font-bold transition-colors whitespace-nowrap leading-tight mt-0.5"
              :class="headerSolid ? 'text-slate-900 hover:text-sky-700' : 'text-white hover:text-sky-300'"
            >
              {{ phone }}
            </a>
          </div>

          <!-- Электронная почта -->
          <div class="flex flex-col whitespace-nowrap">
            <span 
              class="text-[10px] leading-none transition-colors duration-300"
              :class="headerSolid ? 'text-slate-400' : 'text-slate-300'"
            >
              Электронная почта:
            </span>
            <a 
              :href="`mailto:${email}`" 
              class="text-xs sm:text-sm font-semibold transition-colors whitespace-nowrap leading-tight mt-0.5"
              :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white hover:text-sky-300'"
            >
              {{ email }}
            </a>
          </div>
        </div>

        <!-- Мобильная правая часть: только бургер-кнопка (без подложки) -->
        <div class="flex items-center lg:hidden">
          <button 
            type="button" 
            class="flex items-center justify-center p-1 focus:outline-none transition-colors duration-300 cursor-pointer"
            :class="headerSolid ? 'text-slate-900 hover:text-sky-700' : 'text-white hover:text-sky-300'"
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

    <!-- Мобильное выпадающее меню: цвет фона синхронизирован с фоном хедера -->
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
        class="relative z-10 lg:hidden border-t px-5 py-4 space-y-4 transition-colors duration-300"
        :class="headerSolid 
          ? 'bg-white border-slate-200 text-slate-900 shadow-xl' 
          : 'bg-slate-950/95 backdrop-blur-md border-white/10 text-white shadow-2xl'"
      >
        <nav class="flex flex-col" :class="headerSolid ? 'divide-y divide-slate-100' : 'divide-y divide-white/10'">
          <a 
            href="#directions" 
            class="py-2.5 text-base font-medium transition-colors cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-slate-100 hover:text-sky-300'"
            @click="handleNavClick('#directions', $event)"
          >
            Направления
          </a>
          <a 
            href="#news" 
            class="py-2.5 text-base font-medium transition-colors cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-slate-100 hover:text-sky-300'"
            @click="handleNavClick('#news', $event)"
          >
            Новости
          </a>
          <a 
            href="#about" 
            class="py-2.5 text-base font-medium transition-colors cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-slate-100 hover:text-sky-300'"
            @click="handleNavClick('#about', $event)"
          >
            О компании
          </a>
          <a 
            href="#contacts" 
            class="py-2.5 text-base font-medium transition-colors cursor-pointer"
            :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-slate-100 hover:text-sky-300'"
            @click="handleNavClick('#contacts', $event)"
          >
            Контакты
          </a>
        </nav>

        <!-- Контактная информация внутри мобильного меню -->
        <div 
          class="pt-3 border-t space-y-2 text-xs transition-colors duration-300"
          :class="headerSolid ? 'border-slate-200 text-slate-600' : 'border-white/10 text-slate-300'"
        >
          <div>
            <span class="text-[10px] text-slate-400 block uppercase tracking-wider">Справочная служба:</span>
            <a 
              :href="`tel:${phoneRaw}`" 
              class="text-sm font-bold transition-colors"
              :class="headerSolid ? 'text-slate-900 hover:text-sky-700' : 'text-white hover:text-sky-300'"
            >
              {{ phone }}
            </a>
          </div>
          <div>
            <span class="text-[10px] text-slate-400 block uppercase tracking-wider">Электронная почта:</span>
            <a 
              :href="`mailto:${email}`" 
              class="text-xs font-semibold transition-colors"
              :class="headerSolid ? 'text-slate-800 hover:text-sky-700' : 'text-white hover:text-sky-300'"
            >
              {{ email }}
            </a>
          </div>
          <p class="text-[11px] text-slate-400 pt-1 leading-snug">
            ООО «Радиома» — оборудование радиосвязи и навигации с 1995 года
          </p>
        </div>
      </div>
    </transition>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const props = defineProps({
  forceSolid: {
    type: Boolean,
    default: false
  }
})

const baseUrl = import.meta.env.BASE_URL
const router = useRouter()
const route = useRoute()
const isMobileMenuOpen = ref(false)
const isScrolled = ref(false)

const phone = '(495) 725-60-06'
const phoneRaw = '+74957256006'
const email = 'info@radioma.ru'

const headerSolid = computed(() => {
  return props.forceSolid || (route && route.path !== '/' && route.path !== '/transparent') || isScrolled.value
})

function handleScroll() {
  isScrolled.value = window.scrollY > 20
}

function handleNavClick(hash, event) {
  if (event) {
    event.preventDefault()
  }
  isMobileMenuOpen.value = false

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

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true })
  handleScroll()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

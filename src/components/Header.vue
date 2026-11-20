<template>
  <header class="w-full bg-white relative z-30 shadow-[0_4px_20px_rgba(0,0,0,0.18)] border-b border-slate-200">
    <!-- 1. Верхний ярус: Логотип со статусом слева, Контакты справа (десктоп) или Телефон + Бургер (мобильный) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-14">
        <!-- Логотип и статус предприятия справа от логотипа -->
        <router-link to="/" class="flex items-center gap-3">
          <img src="/logo.png" alt="РАДИОМА" class="h-7 sm:h-8 w-auto object-contain" />
          <div class="border-l border-slate-200 pl-3 hidden sm:block">
            <div class="text-[11px] uppercase tracking-wider font-semibold text-slate-800 leading-tight">
              Оборудование связи и навигации
            </div>
            <div class="text-[10px] text-slate-500 leading-tight">
              Поставка, интеграция и сервис
            </div>
          </div>
        </router-link>

        <!-- Контакты справа (Десктоп): Телефон + Электронная почта -->
        <div class="hidden md:flex items-center gap-6 sm:gap-8 text-right">
          <!-- Телефон -->
          <div class="flex flex-col whitespace-nowrap">
            <span class="text-[10px] text-slate-400 leading-none">Справочная служба:</span>
            <a :href="`tel:${phoneRaw}`" class="text-xs sm:text-sm font-bold text-slate-900 hover:text-sky-700 transition-colors whitespace-nowrap leading-tight mt-0.5">
              {{ phone }}
            </a>
          </div>

          <!-- Электронная почта -->
          <div class="border-l border-slate-200 pl-6 sm:pl-8 flex flex-col whitespace-nowrap">
            <span class="text-[10px] text-slate-400 leading-none">Электронная почта:</span>
            <a :href="`mailto:${email}`" class="text-xs sm:text-sm font-semibold text-slate-800 hover:text-sky-700 transition-colors whitespace-nowrap leading-tight mt-0.5">
              {{ email }}
            </a>
          </div>
        </div>

        <!-- Мобильная правая часть: Телефон + Кнопка бургер меню (строго БЕЗ подложки) -->
        <div class="flex items-center gap-3 md:hidden">
          <a :href="`tel:${phoneRaw}`" class="text-xs font-bold text-slate-900 hover:text-sky-700 whitespace-nowrap">
            {{ phone }}
          </a>
          <!-- Кнопка бургер: прозрачная, без фона, без границ, без кругов -->
          <button 
            type="button" 
            class="p-1.5 text-slate-800 hover:text-sky-700 focus:outline-none transition-colors"
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

    <!-- 2. Нижний ярус (Десктоп): выравнивание по всей ширине контейнера (justify-between по сетке от логотипа до email) -->
    <div class="hidden md:block bg-white border-t border-slate-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-11 w-full text-sm font-semibold text-slate-800">
          <a href="#directions" class="hover:text-sky-700 transition-colors whitespace-nowrap">
            Направления
          </a>
          <a href="#systems" class="hover:text-sky-700 transition-colors whitespace-nowrap">
            Оборудование
          </a>
          <a href="#engineering" class="hover:text-sky-700 transition-colors whitespace-nowrap">
            Проектирование
          </a>
          <a href="#about" class="hover:text-sky-700 transition-colors whitespace-nowrap">
            О компании
          </a>
          <a href="#contacts" class="hover:text-sky-700 transition-colors whitespace-nowrap">
            Контакты
          </a>
        </nav>
      </div>
    </div>

    <!-- Мобильное выпадающее меню навигации (аккуратное, строгое, рабочее) -->
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
        class="md:hidden bg-white border-t border-slate-200 shadow-xl px-5 py-4 space-y-4"
      >
        <nav class="flex flex-col divide-y divide-slate-100">
          <a 
            href="#directions" 
            class="py-2.5 text-base font-semibold text-slate-800 hover:text-sky-700 transition-colors"
            @click="isMobileMenuOpen = false"
          >
            Направления
          </a>
          <a 
            href="#systems" 
            class="py-2.5 text-base font-semibold text-slate-800 hover:text-sky-700 transition-colors"
            @click="isMobileMenuOpen = false"
          >
            Оборудование
          </a>
          <a 
            href="#engineering" 
            class="py-2.5 text-base font-semibold text-slate-800 hover:text-sky-700 transition-colors"
            @click="isMobileMenuOpen = false"
          >
            Проектирование
          </a>
          <a 
            href="#about" 
            class="py-2.5 text-base font-semibold text-slate-800 hover:text-sky-700 transition-colors"
            @click="isMobileMenuOpen = false"
          >
            О компании
          </a>
          <a 
            href="#contacts" 
            class="py-2.5 text-base font-semibold text-slate-800 hover:text-sky-700 transition-colors"
            @click="isMobileMenuOpen = false"
          >
            Контакты
          </a>
        </nav>

        <!-- Контактная информация внутри мобильного меню -->
        <div class="pt-3 border-t border-slate-200 space-y-2 text-xs text-slate-600">
          <div>
            <span class="text-[10px] text-slate-400 block uppercase tracking-wider">Справочная служба:</span>
            <a :href="`tel:${phoneRaw}`" class="text-sm font-bold text-slate-900 hover:text-sky-700">
              {{ phone }}
            </a>
          </div>
          <div>
            <span class="text-[10px] text-slate-400 block uppercase tracking-wider">Электронная почта:</span>
            <a :href="`mailto:${email}`" class="text-xs font-semibold text-slate-800 hover:text-sky-700">
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
import { ref } from 'vue'

const isMobileMenuOpen = ref(false)

const phone = '(495) 725-60-06'
const phoneRaw = '+74957256006'
const email = 'office@radioma.ru'
</script>
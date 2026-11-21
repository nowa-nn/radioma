<template>
  <footer class="w-full bg-slate-900 text-slate-300 border-t border-slate-800 py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <!-- Логотип и статус компании -->
        <div class="md:col-span-5 space-y-4">
          <div>
            <img :src="`${baseUrl}logo-white.png`" alt="РАДИОМА" class="h-14 sm:h-16 w-auto object-contain object-left" />
          </div>
          <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
            ООО «Радиома оборудование связи и навигации» — отечественные ведомственные системы радиосвязи, безопасности мореплавания и навигации с 1995 года.
          </p>
        </div>

        <!-- Навигация -->
        <div class="md:col-span-4 space-y-2 text-xs">
          <div class="font-bold text-white uppercase tracking-wider text-[11px] mb-3">
            Разделы сайта
          </div>
          <div class="flex flex-col space-y-2 text-slate-300">
            <a 
              href="#about" 
              class="hover:text-white transition-colors cursor-pointer"
              @click="handleNavClick('#about', $event)"
            >
              О компании
            </a>
            <a 
              href="#directions" 
              class="hover:text-white transition-colors cursor-pointer"
              @click="handleNavClick('#directions', $event)"
            >
              Направления деятельности
            </a>
            <a 
              href="#news" 
              class="hover:text-white transition-colors cursor-pointer"
              @click="handleNavClick('#news', $event)"
            >
              Новости
            </a>
            <a 
              href="#contacts" 
              class="hover:text-white transition-colors cursor-pointer"
              @click="handleNavClick('#contacts', $event)"
            >
              Контакты
            </a>
          </div>
        </div>

        <!-- Контактная сводка -->
        <div class="md:col-span-3 space-y-2 text-xs text-slate-400">
          <div class="font-bold text-white uppercase tracking-wider text-[11px] mb-3">
            Связь с предприятием
          </div>
          <div>
            <span class="block text-[10px] text-slate-500 uppercase">Телефон:</span>
            <a href="tel:+74957256006" class="text-white font-bold hover:text-[#7FD3F5] transition-colors">
              +7 (495) 725-6006
            </a>
          </div>
          <div>
            <span class="block text-[10px] text-slate-500 uppercase">Электронная почта:</span>
            <a href="mailto:office@radioma.ru" class="text-white hover:text-[#7FD3F5] transition-colors">
              office@radioma.ru
            </a>
          </div>
          <div class="pt-1">
            <span class="block text-[10px] text-slate-500 uppercase">Центральный офис:</span>
            <span class="text-slate-300">123104, г. Москва, ул. Малая Бронная, д. 2, стр. 1</span>
          </div>
        </div>
      </div>

      <!-- Нижняя строка -->
      <div class="border-t border-slate-800/80 pt-6 mt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-500">
        <div>
          © 1995–2026 ООО «Радиома оборудование связи и навигации». Все права защищены.
        </div>
        <div class="flex items-center gap-3 sm:gap-4 flex-wrap text-slate-400">
          <a href="#" class="hover:text-white transition-colors cursor-pointer" @click.prevent>
            Политика конфиденциальности
          </a>
          <span class="text-slate-600 hidden sm:inline">•</span>
          <a href="#" class="hover:text-white transition-colors cursor-pointer" @click.prevent>
            Согласие на обработку персональных данных
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useRouter, useRoute } from 'vue-router'

const baseUrl = import.meta.env.BASE_URL
const router = useRouter()
const route = useRoute()

function handleNavClick(hash, event) {
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
</script>

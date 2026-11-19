<template>
  <footer class="w-full bg-slate-900 text-slate-300 border-t border-slate-800 py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <!-- Логотип и статус предприятия -->
        <div class="md:col-span-5 space-y-3">
          <div class="flex items-center gap-3">
            <img :src="`${baseUrl}logo-white.png`" alt="РАДИОМА" class="h-7 w-auto object-contain" />
            <div class="border-l border-slate-700 pl-3">
              <div class="text-[11px] uppercase tracking-wider font-semibold text-white leading-tight">
                Оборудование связи и навигации
              </div>
              <div class="text-[10px] text-slate-400 leading-tight">
                Разработка, производство и сервис
              </div>
            </div>
          </div>
          <p class="text-xs text-slate-400 leading-relaxed max-w-sm pt-1">
            ООО «Радиома оборудование связи и навигации» — отечественные ведомственные системы радиосвязи, безопасности мореплавания и навигации с 1995 года.
          </p>
        </div>

        <!-- Навигация -->
        <div class="md:col-span-4 space-y-2 text-xs">
          <div class="font-bold text-white uppercase tracking-wider text-[11px] mb-3">
            Разделы сайта
          </div>
          <div class="flex flex-col space-y-2 text-slate-300">
            <a href="/#directions" class="hover:text-white transition-colors">Направления деятельности</a>
            <a href="/#news" class="hover:text-white transition-colors">Новости</a>
            <a href="/#about" class="hover:text-white transition-colors">О предприятии</a>
            <a href="/#contacts" class="hover:text-white transition-colors">Контакты и реквизиты</a>
          </div>
        </div>

        <!-- Контактная сводка -->
        <div class="md:col-span-3 space-y-2 text-xs text-slate-400">
          <div class="font-bold text-white uppercase tracking-wider text-[11px] mb-3">
            Связь с предприятием
          </div>
          <div>
            <span class="block text-[10px] text-slate-500 uppercase">Справочная служба:</span>
            <a href="tel:+74957256006" class="text-white font-bold hover:text-sky-300 transition-colors">
              (495) 725-60-06
            </a>
          </div>
          <div>
            <span class="block text-[10px] text-slate-500 uppercase">Электронная почта:</span>
            <a href="mailto:info@radioma.ru" class="text-white hover:text-sky-300 transition-colors">
              info@radioma.ru
            </a>
          </div>
          <div class="pt-1">
            <span class="block text-[10px] text-slate-500 uppercase">Центральный офис:</span>
            <span class="text-slate-300">117393, г. Москва, ул. Профсоюзная, д. 76</span>
          </div>
        </div>
      </div>

      <!-- Нижняя строка -->
      <div class="border-t border-slate-800/80 pt-6 mt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-500">
        <div>
          © 1995–2026 ООО «Радиома оборудование связи и навигации». Все права защищены.
        </div>
        <div>
          Официальный сайт научно-производственного предприятия
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
const baseUrl = import.meta.env.BASE_URL
</script>
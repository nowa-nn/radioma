<template>
  <footer class="w-full bg-[#0a192a] text-slate-300 border-t-4 border-amber-500 mt-12 select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
        <!-- Колонка 1: О компании и предприятии -->
        <div>
          <div class="flex items-center gap-3 mb-4">
            <div class="bg-white p-1.5 rounded">
              <img src="/logo.png" alt="РАДИОМА" class="h-8 w-auto" />
            </div>
            <div>
              <div class="text-xs font-bold uppercase tracking-wider text-white">НПП «РАДИОМА»</div>
              <div class="text-[11px] text-slate-400">Основано в 1995 году</div>
            </div>
          </div>

          <p class="text-xs text-slate-400 leading-relaxed mb-4">
            Российское научно-производственное предприятие по проектированию, строительству и комплексному техническому сопровождению ведомственных систем радиосвязи, навигации и телематики.
          </p>

          <div class="space-y-1.5 text-xs">
            <div class="text-slate-400">Зарегистрированные торговые марки:</div>
            <div class="flex flex-wrap gap-1.5">
              <span class="bg-slate-800 text-amber-400 px-2 py-0.5 rounded text-[10px] font-mono font-bold">РАДИОМА®</span>
              <span class="bg-slate-800 text-sky-400 px-2 py-0.5 rounded text-[10px] font-mono font-bold">САНТЕЙ МОБАЙЛ®</span>
              <span class="bg-slate-800 text-emerald-400 px-2 py-0.5 rounded text-[10px] font-mono font-bold">РАДИОМА ТРАФИК®</span>
            </div>
          </div>
        </div>

        <!-- Колонка 2: Разделы каталога продукции (как на navmarine.ru) -->
        <div>
          <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-slate-700/80 pb-2 mb-3 flex items-center justify-between">
            <span>Каталог оборудования</span>
            <span class="text-[10px] text-amber-400 font-mono">8 направлений</span>
          </div>

          <ul class="space-y-1.5 text-xs">
            <li v-for="cat in catalogPages" :key="cat.id">
              <router-link 
                :to="cat.path" 
                class="text-slate-300 hover:text-amber-400 transition-colors flex items-center gap-1.5 group"
              >
                <span class="text-slate-600 group-hover:text-amber-400 transition-colors">&rsaquo;</span>
                <span>{{ cat.title }}</span>
              </router-link>
            </li>
          </ul>
        </div>

        <!-- Колонка 3: Сервис, инжиниринг и стандарты -->
        <div>
          <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-slate-700/80 pb-2 mb-3">
            Инжиниринг и сервис
          </div>

          <ul class="space-y-1.5 text-xs text-slate-300">
            <li>
              <router-link to="/engineering" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Проектирование радиоцентров</span>
              </router-link>
            </li>
            <li>
              <router-link to="/engineering" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Расчет ЭМС и зон радиопокрытия</span>
              </router-link>
            </li>
            <li>
              <router-link to="/service" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Регламентное сервисное ТО</span>
              </router-link>
            </li>
            <li>
              <router-link to="/service" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Ремонт и склад оригинальных ЗИП</span>
              </router-link>
            </li>
            <li>
              <router-link to="/certificates" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Свидетельства РМРС и РКО</span>
              </router-link>
            </li>
            <li>
              <router-link to="/news" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                <span class="text-slate-600">&rsaquo;</span>
                <span>Новости и полевые испытания</span>
              </router-link>
            </li>
          </ul>

          <div class="mt-4 pt-3 border-t border-slate-800 text-[11px] text-slate-400">
            <div class="font-medium text-slate-300 mb-1">Соответствие стандартам:</div>
            <div>ГОСТ Р, ИМО (IMO), СОЛАС-74, МСЭ (ITU), РМРС, РКО, СРО.</div>
          </div>
        </div>

        <!-- Колонка 4: Контакты и адреса (как на navmarine.ru) -->
        <div>
          <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-slate-700/80 pb-2 mb-3">
            Контакты
          </div>

          <div class="space-y-3 text-xs">
            <div>
              <div class="text-[10px] uppercase text-slate-500 font-medium">Бесплатная линия по России:</div>
              <a :href="`tel:${companyContacts.tollFreePhoneRaw}`" class="text-sm font-bold text-amber-400 hover:underline">
                {{ companyContacts.tollFreePhone }}
              </a>
            </div>

            <div>
              <div class="text-[10px] uppercase text-slate-500 font-medium">Приемная в Москве:</div>
              <a :href="`tel:${companyContacts.phoneRaw}`" class="text-sm font-semibold text-white hover:text-amber-400">
                {{ companyContacts.phone }}
              </a>
              <div class="text-[11px] text-slate-400">Факс: {{ companyContacts.fax }}</div>
            </div>

            <div>
              <div class="text-[10px] uppercase text-slate-500 font-medium">Электронная почта:</div>
              <a :href="`mailto:${companyContacts.email}`" class="text-xs text-slate-200 hover:text-amber-400">
                {{ companyContacts.email }}
              </a>
            </div>

            <div>
              <div class="text-[10px] uppercase text-slate-500 font-medium">Адрес главного офиса:</div>
              <div class="text-slate-300 leading-tight">
                {{ companyContacts.address }}
              </div>
            </div>

            <div>
              <div class="text-[10px] uppercase text-slate-500 font-medium">Режим работы:</div>
              <div class="text-slate-300 text-[11px]">
                {{ companyContacts.workHours }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Нижняя юридическая полоса -->
      <div class="border-t border-slate-800/80 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-500 gap-3">
        <div>
          © 1995–2026 {{ companyContacts.fullName }}. Все права защищены.
        </div>
        <div class="flex items-center gap-4">
          <span>Сайт носит информационный характер</span>
          <span>•</span>
          <router-link to="/contacts" class="text-slate-400 hover:text-slate-200">Реквизиты организации</router-link>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { catalogPages, companyContacts } from '../data/navigation'
</script>

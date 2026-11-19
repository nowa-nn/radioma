<template>
  <div class="w-full">
    <!-- Верхний технический заголовок с хлебными крошками -->
    <div class="bg-[#0b1f33] text-white py-6 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Хлебные крошки -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-3 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <router-link to="/#catalog" class="hover:text-amber-400">Каталог оборудования</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold truncate">{{ currentItem ? currentItem.title : 'Направление' }}</span>
        </nav>

        <div class="flex flex-wrap items-center justify-between gap-4">
          <div>
            <span class="bg-amber-500/20 text-amber-400 border border-amber-500/40 text-[10px] font-mono font-bold px-2.5 py-0.5 rounded uppercase">
              {{ currentItem?.code || 'СИСТЕМЫ СВЯЗИ И НАВИГАЦИИ' }}
            </span>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white mt-1.5">
              {{ currentItem?.title }}
            </h1>
          </div>

          <div class="hidden sm:block text-right text-xs text-slate-300 font-mono">
            <div>НПП «РАДИОМА»</div>
            <div class="text-amber-400">ГОСТ Р / РМРС / РКО</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Основной контент: Двухколоночный макет (Сайдбар каталога слева + Технический паспорт справа) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Сайдбар каталога (как на navmarine.ru) -->
        <aside class="lg:col-span-4 bg-white border border-slate-200 rounded shadow-sm overflow-hidden select-none">
          <div class="bg-slate-900 text-white px-4 py-3 text-xs font-bold uppercase tracking-wider flex items-center justify-between">
            <span>Разделы каталога</span>
            <span class="text-amber-400 font-mono">8</span>
          </div>

          <nav class="divide-y divide-slate-100 text-xs">
            <router-link 
              v-for="cat in catalogPages" 
              :key="cat.id" 
              :to="cat.path"
              class="flex items-center justify-between p-3.5 hover:bg-slate-50 transition-colors group"
              :class="{ 'bg-amber-50 text-slate-900 font-bold border-l-4 border-amber-500': cat.id === currentId }"
            >
              <div class="flex items-center gap-2">
                <span class="text-slate-400 group-hover:text-amber-600 transition-colors">&rsaquo;</span>
                <span class="leading-tight">{{ cat.title }}</span>
              </div>
              <span 
                class="text-[9px] font-mono px-1.5 py-0.5 rounded uppercase"
                :class="cat.id === currentId ? 'bg-amber-200 text-amber-900 font-bold' : 'bg-slate-100 text-slate-500'"
              >
                {{ cat.code }}
              </span>
            </router-link>
          </nav>

          <!-- Информационный блок сервисной помощи в сайдбаре -->
          <div class="p-4 bg-slate-50 border-t border-slate-200 text-xs space-y-2">
            <div class="font-bold text-slate-900">Инженерная консультация:</div>
            <p class="text-slate-600 text-[11px] leading-relaxed">
              По вопросам комплектации, проектных расчетов и освидетельствования оборудования обращайтесь в профильный инженерный отдел:
            </p>
            <div class="font-bold text-slate-900">
              <a :href="`tel:${companyContacts.phoneRaw}`" class="hover:text-amber-600">
                {{ companyContacts.phone }}
              </a>
            </div>
            <div class="text-[11px] text-slate-500">
              E-mail: <a :href="`mailto:${companyContacts.email}`" class="text-sky-700 hover:underline">{{ companyContacts.email }}</a>
            </div>
          </div>
        </aside>

        <!-- Основная колонка со спецификацией и описанием -->
        <main class="lg:col-span-8 bg-white border border-slate-200 rounded shadow-sm p-6 sm:p-8 space-y-8">
          
          <!-- Вводная плашка -->
          <div v-if="currentItem">
            <p class="text-sm sm:text-base text-slate-700 leading-relaxed font-medium">
              {{ currentItem.lead }}
            </p>
          </div>

          <!-- Изображение направления -->
          <div class="w-full h-64 sm:h-80 rounded overflow-hidden relative bg-slate-900 border border-slate-200">
            <img 
              :src="currentNavInfo?.image || '/images/cargo-ocean.jpg'" 
              :alt="currentItem?.title"
              class="w-full h-full object-cover object-center"
            />
            <div class="absolute bottom-2 right-2 bg-slate-900/80 text-white text-[10px] font-mono px-2 py-1 rounded">
              НПП РАДИОМА • ТЕХНИЧЕСКИЙ ПАСПОРТ
            </div>
          </div>

          <!-- Технические разделы -->
          <div v-if="currentItem?.sections" class="space-y-6 divide-y divide-slate-100">
            <div 
              v-for="(sec, idx) in currentItem.sections" 
              :key="idx"
              :class="{ 'pt-6': idx > 0 }"
              class="space-y-3"
            >
              <h2 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded bg-amber-500"></span>
                <span>{{ sec.heading }}</span>
              </h2>

              <p v-if="sec.text" class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                {{ sec.text }}
              </p>

              <!-- Списки функций / состава -->
              <ul v-if="sec.items" class="space-y-2 mt-2">
                <li 
                  v-for="(item, iIdx) in sec.items" 
                  :key="iIdx"
                  class="flex items-start gap-2 text-xs sm:text-sm text-slate-700"
                >
                  <span class="text-amber-600 font-bold mt-0.5">•</span>
                  <span class="leading-relaxed">{{ item }}</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Для направления СУДС-АИС: Таблица ТТХ из брошюры Тритон-92Л -->
          <div v-if="currentItem?.techSpecsTable" class="space-y-4 pt-4 border-t border-slate-200">
            <div class="flex items-center justify-between">
              <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded bg-sky-600"></span>
                <span>Технические параметры лоцманского комплекса АИС «Тритон-92Л»</span>
              </h3>
              <span class="text-[10px] font-mono text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                Данные заводской брошюры
              </span>
            </div>

            <div class="overflow-x-auto border border-slate-200 rounded">
              <table class="w-full text-left text-xs border-collapse">
                <thead>
                  <tr class="bg-slate-100 text-slate-800 font-bold border-b border-slate-200">
                    <th class="p-3">Наименование параметра / тракта</th>
                    <th class="p-3 font-mono">Значение / Диапазон</th>
                    <th class="p-3 font-mono">Параметры приемника</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                  <tr 
                    v-for="(row, rIdx) in currentItem.techSpecsTable" 
                    :key="rIdx"
                    :class="rIdx % 2 === 0 ? 'bg-white' : 'bg-slate-50/60'"
                  >
                    <td class="p-3 font-medium text-slate-800">{{ row.param }}</td>
                    <td class="p-3 font-mono text-slate-600">{{ row.valMin }}</td>
                    <td class="p-3 font-mono text-slate-600">{{ row.valMax }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Спецификационная таблица / Ключевые параметры -->
          <div v-if="currentItem?.features" class="border border-slate-200 rounded overflow-hidden">
            <div class="bg-slate-100 px-4 py-2.5 font-bold text-xs uppercase tracking-wider text-slate-800">
              Сводная сводка характеристик и соответствия
            </div>
            <div class="divide-y divide-slate-200 text-xs">
              <div 
                v-for="(feat, fIdx) in currentItem.features" 
                :key="fIdx"
                class="grid grid-cols-1 sm:grid-cols-3 p-3 gap-2"
                :class="fIdx % 2 === 0 ? 'bg-white' : 'bg-slate-50'"
              >
                <div class="font-bold text-slate-700 sm:col-span-1">{{ feat.label }}:</div>
                <div class="text-slate-900 font-mono sm:col-span-2">{{ feat.val }}</div>
              </div>
            </div>
          </div>

          <!-- Нижняя сервисная плашка -->
          <div class="bg-slate-50 border border-slate-200 rounded p-4 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <div class="space-y-1">
              <div class="font-bold text-slate-900">Запрос технической документации и схем подключения:</div>
              <div class="text-slate-600 text-[11px]">
                Предоставляется проектным институтам, лоцманским службам и судовладельцам по официальному запросу.
              </div>
            </div>
            <div class="flex items-center gap-3">
              <a 
                :href="`mailto:${companyContacts.email}?subject=Запрос документации: ${currentItem?.title}`"
                class="bg-slate-900 hover:bg-slate-800 text-white font-semibold px-4 py-2 rounded transition-colors whitespace-nowrap"
              >
                Запросить документацию
              </a>
            </div>
          </div>

        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { catalogPages, companyContacts } from '../data/navigation'
import { catalogDetails } from '../data/catalog'

const route = useRoute()
const currentId = computed(() => route.params.id || 'suds-ais')

const currentItem = computed(() => {
  return catalogDetails[currentId.value] || catalogDetails['suds-ais']
})

const currentNavInfo = computed(() => {
  return catalogPages.find(p => p.id === currentId.value)
})
</script>

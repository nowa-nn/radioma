<template>
  <section id="directions" class="w-full bg-slate-50 py-12 sm:py-16 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела (строго без надзаголовков, кикеров и мононумерации) -->
      <div class="mb-8 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Направления деятельности
        </h2>
        <p class="text-sm sm:text-base text-slate-600 mt-1.5 max-w-2xl">
          Ведомственные и судовые системы связи, навигации и безопасности мореплавания
        </p>
      </div>

      <!-- Исходная сетка карточек: 4 колонки на десктопе (2 ровных ряда по 4 карточки), 2 на планшете, 1 на мобильном -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
        <article 
          v-for="item in items" 
          :key="item.id"
          class="bg-white border border-slate-200 p-6 flex flex-col justify-between hover:border-slate-400 hover:shadow-sm transition-all duration-150 rounded-sm"
        >
          <div>
            <!-- Лаконичная производственная иконка в спокойных цветах (без цветных подложек) -->
            <div class="text-slate-700">
              <component :is="item.icon" class="w-7 h-7" />
            </div>

            <!-- Наименование направления (в точности по утвержденному списку) -->
            <h3 class="text-base font-bold text-slate-900 leading-snug mt-4">
              <router-link :to="`/directions/${item.id}`" class="hover:text-sky-700 transition-colors">
                {{ item.title }}
              </router-link>
            </h3>

            <!-- Краткое описание назначения и номенклатуры -->
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2.5">
              {{ item.description }}
            </p>
          </div>

          <!-- Ссылка перехода -->
          <div class="pt-4 mt-5 border-t border-slate-100">
            <router-link 
              :to="`/directions/${item.id}`" 
              class="inline-flex items-center gap-1.5 text-xs font-semibold text-sky-700 hover:text-sky-900 transition-colors"
            >
              <span>Подробнее</span>
              <span>→</span>
            </router-link>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script setup>
import { h } from 'vue'

// Векторные строгие технические иконки (без цветных фонов)
const IconGmssb = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('circle', { cx: '12', cy: '12', r: '9' }),
  h('circle', { cx: '12', cy: '12', r: '4' }),
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M12 3v5m0 8v5M3 12h5m8 0h5' })
])

const IconSudsAis = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('circle', { cx: '12', cy: '12', r: '9' }),
  h('circle', { cx: '12', cy: '12', r: '5' }),
  h('circle', { cx: '12', cy: '12', r: '1' }),
  h('path', { strokeLinecap: 'round', d: 'M12 12l6 -6' }),
  h('path', { strokeLinecap: 'round', d: 'M12 3v2m0 14v2M3 12h2m14 0h2' })
])

const IconMarineRadio = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('rect', { x: '5', y: '8', width: '14', height: '13', rx: '2' }),
  h('path', { strokeLinecap: 'round', d: 'M8 8V3m8 5V5' }),
  h('circle', { cx: '12', cy: '14', r: '3' }),
  h('line', { x1: '8', y1: '19', x2: '16', y2: '19' })
])

// Сохраненная новая специализированная иконка транкинговой радиосвязи (ретрансляционная вышка с радиоволнами TETRA / DMR)
const IconTrunking = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M8 22l4-12 4 12' }),
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M9.5 17.5h5' }),
  h('circle', { cx: '12', cy: '10', r: '2', fill: 'currentColor' }),
  h('line', { x1: '12', y1: '2', x2: '12', y2: '8', strokeLinecap: 'round' }),
  h('path', { strokeLinecap: 'round', d: 'M7.5 6a6 6 0 0 0 0 8' }),
  h('path', { strokeLinecap: 'round', d: 'M4.5 3.5a10 10 0 0 0 0 13' }),
  h('path', { strokeLinecap: 'round', d: 'M16.5 6a6 6 0 0 1 0 8' }),
  h('path', { strokeLinecap: 'round', d: 'M19.5 3.5a10 10 0 0 1 0 13' })
])

const IconMonitoring = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z' }),
  h('circle', { cx: '12', cy: '10', r: '3' })
])

const IconRadiocenters = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M3 21h18M5 21V7l7-4 7 4v14M9 10h1m4 0h1M9 14h1m4 0h1M9 18h1m4 0h1' })
])

const IconAntennas = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M12 22V8m0 0L6 3m6 5l6-5M4 11a12 12 0 0 1 16 0M7 14a8 8 0 0 1 10 0' })
])

const IconMaintenance = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', strokeWidth: 1.5 }, [
  h('path', { strokeLinecap: 'round', strokeLinejoin: 'round', d: 'M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z' })
])

// 8 утвержденных направлений (карточек)
const items = [
  {
    id: 'gmssb',
    title: 'Системы глобальной морской связи при бедствии для обеспечения безопасности мореплавания (ГМССБ)',
    description: 'Береговые и судовые комплексы радиосвязи морских районов А1, А2 и А3, аварийные радиобуи, радиолокационные ответчики и оборудование ИБМ.',
    icon: IconGmssb,
    link: '#gmssb'
  },
  {
    id: 'suds-ais',
    title: 'Оборудование систем управления судов (СУДС - АИС)',
    description: 'Береговые базовые станции АИС, лоцманские комплексы, приемоиндикаторы и диспетчерские системы координации движения судов на фарватерах и в портах.',
    icon: IconSudsAis,
    link: '#suds-ais'
  },
  {
    id: 'marine-radio',
    title: 'Радиостанции для морского и речного флота',
    description: 'Стационарные, судовые и портативные радиостанции УКВ и КВ диапазонов «РАДИОМА» и «САНТЕЙ МОБАЙЛ» с типовым одобрением РМРС и РКО.',
    icon: IconMarineRadio,
    link: '#marine-radio'
  },
  {
    id: 'trunking',
    title: 'Оборудование и системы транкинговой радиосвязи',
    description: 'Цифровые и аналоговые транкинговые радиосистемы стандартов DMR и TETRA, базовые ретрансляторы, пульты управления и абонентские терминалы.',
    icon: IconTrunking,
    link: '#trunking'
  },
  {
    id: 'monitoring',
    title: 'Системы и оборудование навигации и мониторинга транспортных средств',
    description: 'Бортовые телематические терминалы ГЛОНАСС/GPS, контроллеры расхода топлива и комплексы автоматизированного диспетчерского контроля транспорта.',
    icon: IconMonitoring,
    link: '#monitoring'
  },
  {
    id: 'radiocenters',
    title: 'Проектирование и строительство радиоцентров',
    description: 'Проектно-изыскательские, строительно-монтажные и пусконаладочные работы по возведению береговых радиоцентров и ведомственных узлов связи под ключ.',
    icon: IconRadiocenters,
    link: '#radiocenters'
  },
  {
    id: 'antennas',
    title: 'Антенны и антенные системы',
    description: 'Судовые и стационарные антенны УКВ, КВ, СВ/ДВ диапазонов, антенно-фидерные тракты, грозоразрядники, делители мощности и коммутаторы.',
    icon: IconAntennas,
    link: '#antennas'
  },
  {
    id: 'maintenance',
    title: 'Техническое обслуживание и ремонт техники связи',
    description: 'Регламентное ТО, ремонт, диагностика параметров и периодическое техническое освидетельствование оборудования связи и навигации в сертифицированной лаборатории.',
    icon: IconMaintenance,
    link: '#maintenance'
  }
]
</script>
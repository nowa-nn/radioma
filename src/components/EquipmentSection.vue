<template>
  <section id="systems" class="w-full bg-white border-t border-slate-200 py-14 sm:py-20 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-10 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Оборудование и серийная продукция
        </h2>
        <p class="text-sm sm:text-base text-slate-600 mt-1.5 max-w-2xl">
          Разработка и серийный выпуск сертифицированной аппаратуры радиосвязи, навигации и автоматизированного диспетчерского контроля
        </p>
      </div>

      <!-- Сетка серийных линеек оборудования -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="item in equipmentList" 
          :key="item.id"
          class="bg-slate-50/70 border border-slate-200 p-6 flex flex-col justify-between rounded-sm hover:border-slate-300 transition-colors"
        >
          <div class="space-y-3">
            <!-- Код категории / стандарта -->
            <div class="text-[11px] font-semibold tracking-wider text-slate-500 uppercase">
              {{ item.category }}
            </div>

            <!-- Название линейки -->
            <h3 class="text-base font-bold text-slate-900 leading-snug">
              {{ item.title }}
            </h3>

            <!-- Описание номенклатуры -->
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
              {{ item.description }}
            </p>

            <!-- Технические параметры и стандарты -->
            <div class="pt-3 border-t border-slate-200/80 space-y-1.5 text-xs text-slate-700">
              <div v-for="(spec, sIdx) in item.specs" :key="sIdx" class="flex items-start gap-2">
                <span class="text-slate-400 font-mono select-none">•</span>
                <span>{{ spec }}</span>
              </div>
            </div>
          </div>

          <!-- Ссылка на спецификацию -->
          <div class="pt-4 mt-5 border-t border-slate-200/60">
            <a 
              :href="item.link" 
              class="inline-block text-xs font-semibold text-sky-700 hover:text-sky-900 transition-colors"
            >
              Техническое описание
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const equipmentList = [
  {
    id: 'marine-radios',
    category: 'Судовая радиосвязь',
    title: 'Радиостанции УКВ и КВ флота «РАДИОМА» и «САНТЕЙ МОБАЙЛ»',
    description: 'Стационарные судовые и портативные радиостанции для морских и внутренних водных путей с цифровым избирательным вызовом.',
    specs: [
      'Диапазоны: УКВ (156–162 МГц, 300–337 МГц), КВ (1.6–30 МГц)',
      'Сертификаты РМРС и РКО для конвенционных и неконвенционных судов',
      'Защищенное исполнение корпуса по стандарту IP56 / IP67'
    ],
    link: '#marine-radio'
  },
  {
    id: 'suds-ais',
    category: 'Безопасность мореплавания',
    title: 'Береговые станции и лоцманские комплексы АИС',
    description: 'Аппаратно-программные средства координации движения судов в акваториях портов, на подходах и внутренних водных путях.',
    specs: [
      'Лоцманские портативные комплекты АИС класса А «Тритон-92Л»',
      'Береговые базовые станции АИС «Тритон-92С» и ретрансляторы',
      'Интеграция с радиолокационными станциями и картографическими серверами'
    ],
    link: '#suds-ais'
  },
  {
    id: 'gmssb-complex',
    category: 'Аварийно-спасательная радиосвязь',
    title: 'Комплексы радиооборудования систем ГМССБ',
    description: 'Оборудование непрерывного несения радиовахты при бедствии и обеспечения безопасности мореплавания.',
    specs: [
      'Оснащение морских районов плавания А1, А2 и А3 (включая акваторию СМП)',
      'Приемопередатчики ЦИВ, приемники НАВТЕКС, спутниковые АРБ Коспас-Сарсат',
      'РЛС-ответчики (РЛО) и аварийные носимые радиостанции'
    ],
    link: '#gmssb'
  },
  {
    id: 'trunking-systems',
    category: 'Технологическая радиосвязь',
    title: 'Оборудование транкинговых сетей DMR и TETRA',
    description: 'Профессиональные цифровые диспетчерские системы подвижной радиосвязи для ведомств, портовых служб и промышленных объектов.',
    specs: [
      'Базовые ретрансляторы и контроллеры транкинговых зон',
      'Портативные и автомобильные терминалы специального назначения',
      'Защищенный протокол передачи голосовых данных и телеметрии'
    ],
    link: '#trunking'
  },
  {
    id: 'traffic-monitoring',
    category: 'Спутниковая телематика',
    title: 'Навигационно-связные терминалы «РАДИОМА Трафик»',
    description: 'Бортовые комплексы непрерывного мониторинга транспорта там, где отсутствует сотовая и наземная инфраструктура.',
    specs: [
      'Совмещенный высокоточный приемник ГЛОНАСС / GPS',
      'Резервирование каналов передачи данных: КВ-радиоканал и спутник',
      'Подключение датчиков расхода топлива и технологических параметров'
    ],
    link: '#monitoring'
  },
  {
    id: 'antennas-afu',
    category: 'Антенно-фидерные устройства',
    title: 'Антенные системы всепогодного специального исполнения',
    description: 'Широкополосные стационарные и судовые антенно-фидерные тракты, рассчитанные на экстремальные условия эксплуатации.',
    specs: [
      'Диапазоны: ДВ, СВ, КВ, УКВ морского и речного применения',
      'Устойчивость к соляному туману, обледенению и ветру до 50 м/с',
      'Грозоразрядники, полосовые фильтры и согласующие трансформаторы'
    ],
    link: '#antennas'
  }
]
</script>
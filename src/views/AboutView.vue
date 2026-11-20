<template>
  <div class="w-full">
    <!-- Шапка страницы -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">О компании</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          О компании «РАДИОМА»
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          Поставка, интеграция и сервис систем радиосвязи и навигации с 1995 года.
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-10">
        
        <!-- Блок истории и миссии -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          <div class="lg:col-span-8 space-y-4 text-slate-700 text-sm leading-relaxed">
            <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
              История развития и профиль деятельности
            </h2>
            <p>
              Компания <strong>РАДИОМА</strong> с момента своего основания в <strong>1995 году</strong> занимается комплексными поставками, установкой и обслуживанием ведомственных и судовых систем радиосвязи и навигации.
            </p>
            <p>
              За более чем 30 лет компания зарекомендовала себя как надежный партнер, реализующий комплексные инфраструктурные проекты по всей территории Российской Федерации — от Балтики до Тихого океана, в акватории СМП и бассейнах рек Сибири и Дальнего Востока.
            </p>
            <p>
              Широкие компетенции в области береговых систем безопасности мореплавания, систем и оборудования управления движения судов (СУДС-АИС) и мониторинга транспортных средств, радиосвязи и систем оповещения населения, коротковолновой цифровой радиосвязи для удаленных и труднодоступных районов под марками <strong>РАДИОМА</strong> и <strong>САНТЕЙ МОБАЙЛ</strong> зарекомендовали себя у государственных и коммерческих заказчиков.
            </p>
          </div>

          <!-- Карточка ключевых фактов -->
          <div class="lg:col-span-4 bg-slate-50 border border-slate-200 rounded p-6 space-y-4">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-900 border-b border-slate-200 pb-2">
              Паспорт предприятия
            </div>
            <div class="space-y-3 text-xs">
              <div>
                <span class="text-slate-500 block">Полное наименование:</span>
                <span class="font-semibold text-slate-900">{{ companyContacts.fullName }}</span>
              </div>
              <div>
                <span class="text-slate-500 block">Год основания:</span>
                <span class="font-mono font-bold text-slate-900">1995 год (30+ лет на рынке)</span>
              </div>
              <div>
                <span class="text-slate-500 block">Основные торговые марки:</span>
                <span class="font-bold text-amber-700">РАДИОМА®, САНТЕЙ МОБАЙЛ®, РАДИОМА Трафик®</span>
              </div>
              <div>
                <span class="text-slate-500 block">Статус:</span>
                <span class="text-slate-900">Признанный изготовитель оборудования (свидетельство РМРС)</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Ключевые направления компетенций -->
        <div class="space-y-6">
          <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
            Основные направления деятельности
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">01. ВЕДОМСТВЕННЫЕ РАДИОЦЕНТРЫ</div>
              <div class="font-bold text-slate-900 text-sm">Проектирование и возведение АМС</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Расчет электромагнитной совместимости (ЭМС), проектирование радиоцентров, монтаж мачт и башен до 100+ метров, оснащение аппаратных контейнеров.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">02. СПУТНИКОВАЯ ТЕЛЕМАТИКА</div>
              <div class="font-bold text-slate-900 text-sm">Система «РАДИОМА Трафик»</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Контроль и управление транспортом там, где заканчивается наземная инфраструктура: резервирование через КВ-радиоканал и спутники.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">03. ТРАНКИНГОВАЯ СВЯЗЬ</div>
              <div class="font-bold text-slate-900 text-sm">Сети стандартов DMR и TETRA</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Построение защищенных технологических систем подвижной радиосвязи для промышленных предприятий, портовых терминалов и ведомств.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">04. ЛОЦМАНСКИЕ КОМПЛЕКСЫ</div>
              <div class="font-bold text-slate-900 text-sm">АИС «Тритон-92Л» и СУДС «Тритон-92С»</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Поставка и обслуживание портативных лоцманских комплектов АИС класса А и стационарных береговых базовых станций контроля судоходства.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">05. АВАРИЙНАЯ РАДИОСВЯЗЬ</div>
              <div class="font-bold text-slate-900 text-sm">Комплексы систем ГМССБ</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Оснащение судов и береговых радиоцентров для непрерывного несения радиовахты в морских районах А1, А2 и А3.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="text-xs font-mono font-bold text-amber-600">06. АНТЕННО-ФИДЕРНЫЕ ТРАКТЫ</div>
              <div class="font-bold text-slate-900 text-sm">Антенны специального исполнения</div>
              <p class="text-xs text-slate-600 leading-relaxed">
                Разработка и выпуск всепогодных антенных систем, устойчивых к соляному туману, вибрациям и ураганным ветрам (до 50 м/с).
              </p>
            </div>
          </div>
        </div>

        <!-- Гарантийные обязательства -->
        <div class="bg-slate-50 border-l-4 border-amber-500 p-6 rounded text-xs sm:text-sm text-slate-800 space-y-2">
          <div class="font-bold text-slate-900 text-base">Гарантийные обязательства и авторский надзор:</div>
          <p class="leading-relaxed">
            На всю производимую технику мы даем <strong>расширенную заводскую гарантию</strong> и осуществляем комплексное проектирование, техническое сопровождение построенных систем связи и навигации, авторский надзор, поставку ЗИП и регламентное освидетельствование.
          </p>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { companyContacts } from '../data/navigation'
</script>

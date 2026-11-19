<template>
  <div class="w-full">
    <!-- Шапка -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">Инжиниринг и строительство</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Проектирование и строительство радиоцентров
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          Инженерные изыскания, расчет электромагнитной совместимости, возведение АМС и сдача объектов «под ключ».
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 space-y-4 text-sm text-slate-700 leading-relaxed">
            <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
              Строительство объектов ведомственной радиосвязи
            </h2>
            <p>
              Строительно-инжиниринговое подразделение компании <strong>РАДИОМА</strong> обладает многолетним опытом создания стационарных приемо-передающих радиоцентров, береговых постов СУДС, систем оповещения и телематических узлов в труднодоступных районах РФ.
            </p>
            <p>
              Мы выполняем функции генерального проектировщика и генерального подрядчика (EPC-контракт), обеспечивая полное сопровождение объекта: от выбора земельного участка и прохождения государственной экспертизы до ввода в эксплуатацию и регистрации РЭС в органах Роскомнадзора.
            </p>
          </div>

          <div class="lg:col-span-5 h-64 rounded overflow-hidden border border-slate-200 shadow-sm">
            <img src="/images/slide-radiocenters.jpg" alt="Строительство радиоцентров" class="w-full h-full object-cover" />
          </div>
        </div>

        <!-- Этапы реализации -->
        <div class="space-y-6">
          <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
            Регламент инженерно-строительных работ
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs sm:text-sm">
            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                <span class="bg-amber-500 text-slate-950 px-2 py-0.5 rounded font-mono text-xs">01</span>
                <span>Предпроектные изыскания и расчет ЭМС</span>
              </div>
              <p class="text-slate-600 leading-relaxed">
                Комплексные инженерно-геодезические и геологические изыскания площадки. Компьютерное моделирование зон радиопокрытия с учетом рельефа местности и расчет электромагнитной совместимости радиоэлектронных средств.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                <span class="bg-amber-500 text-slate-950 px-2 py-0.5 rounded font-mono text-xs">02</span>
                <span>Проектирование и экспертиза (Стадии «П» и «Р»)</span>
              </div>
              <p class="text-slate-600 leading-relaxed">
                Разработка полного комплекта проектной документации: архитектурные и конструктивные решения, схемы АФУ, гарантированное электроснабжение, системы заземления и молниезащиты.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                <span class="bg-amber-500 text-slate-950 px-2 py-0.5 rounded font-mono text-xs">03</span>
                <span>Монтаж АМС и технологических модулей</span>
              </div>
              <p class="text-slate-600 leading-relaxed">
                Устройство монолитных фундаментов, монтаж свободностоящих башен и мачт на оттяжках высотой от 30 до 100+ метров. Установка климатических контейнеров с автоматическим резервированием питания (ДГУ, ИБП).
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                <span class="bg-amber-500 text-slate-950 px-2 py-0.5 rounded font-mono text-xs">04</span>
                <span>Пусконаладка, юстировка и сдача объекта</span>
              </div>
              <p class="text-slate-600 leading-relaxed">
                Монтаж приемопередающего тракта, юстировка антенн, измерение КСВн фидерных линий, проведение приемо-сдаточных испытаний и оформление санитарно-эпидемиологических заключений.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

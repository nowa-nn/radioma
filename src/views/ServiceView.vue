<template>
  <div class="w-full">
    <!-- Шапка страницы -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">Сервисный центр</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Сервисный центр, ТО и ремонт техники связи
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          Авторизованное сервисное обслуживание, компонентный ремонт, периодическая поверка и склад оригинальных ЗИП.
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-8 space-y-4 text-sm text-slate-700 leading-relaxed">
            <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
              Техническое сопровождение и расширенная гарантия
            </h2>
            <p>
              Сервисная служба <strong>НПП «РАДИОМА»</strong> обеспечивает поддержку аппаратуры на всех стадиях её жизненного цикла. На всё серийно выпускаемое оборудование предоставляется расширенная заводская гарантия.
            </p>
            <p>
              Лаборатория оснащена современным контрольно-измерительным оборудованием: прецизионными векторными анализаторами цепей, генераторами радиочастотных сигналов, измерителями модуляции и климатическими камерами. Это позволяет оперативно проводить локализацию неисправностей и сложный восстановительный ремонт на уровне компонентов.
            </p>
          </div>

          <div class="lg:col-span-4 h-60 rounded overflow-hidden border border-slate-200 shadow-sm">
            <img src="/images/service-lab.jpg" alt="Сервисная лаборатория РАДИОМА" class="w-full h-full object-cover" />
          </div>
        </div>

        <!-- Виды сервисных программ -->
        <div class="space-y-6">
          <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
            Виды оказываемых услуг и регламентных работ
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs sm:text-sm">
            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm text-amber-700">Регламентное сервисное ТО</div>
              <p class="text-slate-600 leading-relaxed">
                Плановые проверки радиостанций, лоцманских комплексов АИС «Тритон-92Л», транспондеров и базовых станций СУДС с контролем чувствительности и выходной мощности.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm text-amber-700">Компонентный ремонт аппаратуры</div>
              <p class="text-slate-600 leading-relaxed">
                Восстановление высокочастотных модулей, синтезаторов частоты, плат питания и процессоров с использованием оригинальных заводских радиодеталей.
              </p>
            </div>

            <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-2">
              <div class="font-bold text-slate-900 text-sm text-amber-700">Освидетельствование и поверка</div>
              <p class="text-slate-600 leading-relaxed">
                Ежегодное техническое освидетельствование оборудования с оформлением документов РМРС и РКО для судовладельцев и портовых операторов.
              </p>
            </div>
          </div>
        </div>

        <!-- Склад ЗИП и выездные бригады -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 border border-slate-200 rounded p-6">
          <div>
            <div class="font-bold text-slate-900 text-sm mb-1">Центральный склад ЗИП в Москве:</div>
            <p class="text-xs text-slate-600 leading-relaxed">
              Постоянное наличие запасных блоков, манипуляторов, антенных согласующих устройств, кабельных сборок и комплектующих для оперативной отгрузки заказчикам в течение 24 часов.
            </p>
          </div>
          <div>
            <div class="font-bold text-slate-900 text-sm mb-1">Мобильные инженерные группы:</div>
            <p class="text-xs text-slate-600 leading-relaxed">
              Выезд инженеров на объекты заказчиков, портовые терминалы и стоянки судов по всей территории РФ для проведения диагностики и аварийно-восстановительных работ.
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<template>
  <div class="w-full">
    <!-- Шапка страницы -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">Сертификаты и допуски</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Сертификаты, лицензии и допуски СРО
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          Свидетельства типового одобрения РМРС, РКО, членство в проектных и строительных СРО.
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-10">
        
        <div class="space-y-4 text-sm text-slate-700 leading-relaxed">
          <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
            Государственная разрешительная документация
          </h2>
          <p>
            Деятельность <strong>ООО «Радиома оборудование связи и навигации»</strong> осуществляется в строгом соответствии с законодательством Российской Федерации. Компания имеет все необходимые разрешительные документы, лицензии и свидетельства для поставки, монтажа, интеграции и технического обслуживания ведомственных радиосистем.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs sm:text-sm">
          <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-3">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
              <span class="font-bold text-slate-900">Российский морской регистр судоходства (РМРС)</span>
              <span class="text-[10px] font-mono bg-sky-100 text-sky-800 px-2 py-0.5 rounded font-bold">РМРС</span>
            </div>
            <p class="text-slate-600 leading-relaxed text-xs">
              Свидетельства о признании предприятия на право выполнения работ по проектированию, монтажу, пусконаладке, ремонту и ТО судового радио- и навигационного оборудования, а также аппаратуры ГМССБ.
            </p>
            <div class="text-[11px] text-slate-500 font-mono">
              Область действия: Морские районы А1, А2, А3.
            </div>
          </div>

          <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-3">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
              <span class="font-bold text-slate-900">Российское Классификационное Общество (РКО)</span>
              <span class="text-[10px] font-mono bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-bold">РКО</span>
            </div>
            <p class="text-slate-600 leading-relaxed text-xs">
              Свидетельство о признании изготовителя судового навигационного оборудования и радиостанций речного диапазона. Свидетельства типового одобрения на лоцманские комплексы АИС «Тритон-92Л».
            </p>
            <div class="text-[11px] text-slate-500 font-mono">
              Область действия: Внутренние водные пути РФ.
            </div>
          </div>

          <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-3">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
              <span class="font-bold text-slate-900">СРО «Проектирование объектов связи»</span>
              <span class="text-[10px] font-mono bg-amber-100 text-amber-800 px-2 py-0.5 rounded font-bold">СРО-П</span>
            </div>
            <p class="text-slate-600 leading-relaxed text-xs">
              Право осуществления подготовки проектной документации для объектов капитального строительства, включая особо опасные, технически сложные и уникальные объекты связи и радиоцентры.
            </p>
          </div>

          <div class="p-5 bg-slate-50 border border-slate-200 rounded space-y-3">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
              <span class="font-bold text-slate-900">СРО «Строительство и монтаж сооружений связи»</span>
              <span class="text-[10px] font-mono bg-amber-100 text-amber-800 px-2 py-0.5 rounded font-bold">СРО-С</span>
            </div>
            <p class="text-slate-600 leading-relaxed text-xs">
              Допуск к строительству, реконструкции и капитальному ремонту антенно-мачтовых сооружений, монтажу технологического оборудования радиоцентров и волоконно-оптических линий связи.
            </p>
          </div>
        </div>

        <div class="bg-slate-50 border-l-4 border-amber-500 p-4 rounded text-xs text-slate-700 leading-relaxed">
          Заверенные копии свидетельств и сертификатов соответствия на конкретные типы поставляемой аппаратуры предоставляются проектным организациям и заказчикам по официальному запросу на электронную почту <strong>info@radioma.ru</strong>.
        </div>

      </div>
    </div>
  </div>
</template>

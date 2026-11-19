<template>
  <section id="engineering" class="w-full bg-slate-50 border-t border-slate-200 py-14 sm:py-20 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-10 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Проектирование и строительство радиоцентров
        </h2>
        <p class="text-sm sm:text-base text-slate-600 mt-1.5 max-w-2xl">
          Полный цикл создания стационарных объектов связи, береговых постов СУДС и антенно-мачтовых сооружений «под ключ»
        </p>
      </div>

      <!-- Основной блок с описанием и фото объекта -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-12">
        <div class="lg:col-span-7 space-y-4 text-sm text-slate-700 leading-relaxed">
          <p>
            Инженерно-строительное подразделение предприятия <strong>«РАДИОМА»</strong> выполняет функции генерального проектировщика и генерального подрядчика (EPC-контракты) при создании приемо-передающих радиоцентров, береговых узлов связи и диспетчерских пунктов в сложных климатических условиях Российской Федерации.
          </p>
          <p>
            Мы обеспечиваем полное юридическое и техническое сопровождение объектов: от инженерно-геодезических изысканий и прохождения государственной экспертизы до возведения башенных сооружений, пусконаладки приемо-передающего оборудования и оформления разрешительной документации в надзорных органах.
          </p>
          <div class="pt-2 flex flex-wrap gap-x-6 gap-y-2 text-xs font-semibold text-slate-800">
            <span class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
              Работа по 44-ФЗ, 223-ФЗ и ГОЗ
            </span>
            <span class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
              Казначейское и банковское сопровождение
            </span>
            <span class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
              Авторский надзор и гарантийное ТО
            </span>
          </div>
        </div>

        <div class="lg:col-span-5 h-64 sm:h-72 rounded-sm overflow-hidden border border-slate-200">
          <img 
            src="/images/slide-radiocenters.jpg" 
            alt="Строительство береговых радиоцентров" 
            class="w-full h-full object-cover object-center"
          />
        </div>
      </div>

      <!-- 4 этапа регламентных инженерно-строительных работ -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
        <div 
          v-for="step in steps" 
          :key="step.number"
          class="bg-white border border-slate-200 p-6 rounded-sm space-y-3"
        >
          <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">
            Этап {{ step.number }}
          </div>
          <h3 class="text-base font-bold text-slate-900 leading-snug">
            {{ step.title }}
          </h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            {{ step.description }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const steps = [
  {
    number: '01',
    title: 'Изыскания и расчет ЭМС',
    description: 'Инженерно-геодезические и геологические изыскания площадки. Моделирование зон радиопокрытия с учетом рельефа и расчет электромагнитной совместимости РЭС.'
  },
  {
    number: '02',
    title: 'Проектирование и экспертиза',
    description: 'Разработка комплекта проектно-сметной документации (стадии «П» и «Р»): расчет конструкций АМС, схемы АФУ, гарантированное электроснабжение и молниезащита.'
  },
  {
    number: '03',
    title: 'Монтаж АМС и аппаратных',
    description: 'Устройство фундаментов, монтаж свободностоящих башен и мачт высотой от 30 до 100+ метров. Установка климатических контейнеров с автоматическим ДГУ и ИБП.'
  },
  {
    number: '04',
    title: 'Пусконаладка и сдача объекта',
    description: 'Юстировка антенн, измерение КСВн фидерных линий, проведение приемо-сдаточных испытаний и регистрация радиоэлектронных средств в органах Роскомнадзора.'
  }
]
</script>
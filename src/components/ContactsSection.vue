<template>
  <section id="contacts" class="w-full bg-slate-50 py-12 sm:py-16 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-8 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Контакты и реквизиты
        </h2>
      </div>

      <!-- Двухколоночный блок: контакты и официальные реквизиты одинаковой высоты на десктопе -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        <!-- Левая часть: Центральный офис -->
        <div class="lg:col-span-7 bg-white border border-slate-200 rounded-sm p-6 sm:p-8 flex flex-col justify-between h-full">
          <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">
              Центральный офис
            </h3>

            <div class="space-y-4 text-xs sm:text-sm text-slate-700 mt-5">
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 items-baseline">
                <span class="text-slate-400 font-medium">Адрес:</span>
                <span class="sm:col-span-2 font-medium text-slate-900">
                  117393, г. Москва, ул. Профсоюзная, д. 76
                </span>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 items-baseline">
                <span class="text-slate-400 font-medium">Справочная служба:</span>
                <div class="sm:col-span-2">
                  <a :href="`tel:${phoneRaw}`" class="font-bold text-slate-900 text-base hover:text-sky-700 transition-colors">
                    {{ phone }}
                  </a>
                  <div class="text-xs text-slate-500 mt-0.5">Факс: {{ fax }}</div>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 items-baseline">
                <span class="text-slate-400 font-medium">Электронная почта:</span>
                <div class="sm:col-span-2">
                  <a :href="`mailto:${email}`" class="font-semibold text-sky-700 hover:text-sky-900 transition-colors">
                    {{ email }}
                  </a>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 items-baseline">
                <span class="text-slate-400 font-medium">Режим работы:</span>
                <div class="sm:col-span-2 text-slate-800">
                  <div>Понедельник — пятница: с 09:00 до 18:00 (МСК)</div>
                  <div class="text-xs text-slate-500 mt-0.5">Суббота, воскресенье: выходные дни</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Правая часть: Реквизиты организации -->
        <div class="lg:col-span-5 bg-white border border-slate-200 rounded-sm p-6 sm:p-8 flex flex-col justify-between h-full">
          <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">
              Реквизиты организации
            </h3>

            <div class="space-y-4 text-xs sm:text-sm text-slate-700 mt-5">
              <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="text-slate-400">Полное наименование:</span>
                <span class="font-semibold text-right text-slate-900 ml-2">ООО «Радиома оборудование связи и навигации»</span>
              </div>
              <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="text-slate-400">ИНН / КПП:</span>
                <span class="font-semibold text-slate-900">7728148920 / 772801001</span>
              </div>
              <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="text-slate-400">ОГРН:</span>
                <span class="font-semibold text-slate-900">1027700348210</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-400">ОКПО:</span>
                <span class="font-semibold text-slate-900">40284910</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const phone = '(495) 725-60-06'
const phoneRaw = '+74957256006'
const fax = '(495) 725-60-08'
const email = 'info@radioma.ru'
</script>

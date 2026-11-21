<template>
  <section id="contacts" class="w-full bg-slate-50 py-12 sm:py-16 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-8 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Контакты
        </h2>
      </div>

      <!-- Двухколоночный блок: контакты слева, интерактивная карта офиса справа -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        <!-- Левая часть: Центральный офис -->
        <div class="lg:col-span-5 bg-white border border-slate-200 rounded-sm p-6 sm:p-8 flex flex-col justify-between h-full shadow-sm">
          <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">
              Центральный офис
            </h3>

            <div class="space-y-4 text-xs sm:text-sm text-slate-700 mt-5">
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-2 items-baseline">
                <span class="text-slate-400 font-medium">Адрес:</span>
                <span class="sm:col-span-2 font-medium text-slate-900 leading-snug">
                  123104, г. Москва, ул. Малая Бронная, д. 2, стр. 1
                  <a 
                    href="https://yandex.ru/maps/?text=123104%2C%20%D0%B3.%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%2C%20%D1%83%D0%BB.%20%D0%9C%D0%B0%D0%BB%D0%B0%D1%8F%20%D0%91%D1%80%D0%BE%D0%BD%D0%BD%D0%B0%D1%8F%2C%20%D0%B4.%202%2C%20%D1%81%D1%82%D1%80.%201" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="block text-xs font-normal text-[#0093CB] hover:underline mt-1"
                  >
                    Показать на Яндекс.Картах →
                  </a>
                </span>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-2 items-baseline">
                <span class="text-slate-400 font-medium">Телефон:</span>
                <div class="sm:col-span-2">
                  <a :href="`tel:${phoneRaw}`" class="font-bold text-slate-900 text-base hover:text-[#0093CB] transition-colors">
                    {{ phone }}
                  </a>
                  <div class="text-xs text-slate-500 mt-0.5">Факс: {{ fax }}</div>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-2 items-baseline">
                <span class="text-slate-400 font-medium">Электронная почта:</span>
                <div class="sm:col-span-2">
                  <a :href="`mailto:${email}`" class="font-semibold text-[#0093CB] hover:text-[#007EAF] transition-colors">
                    {{ email }}
                  </a>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-2 items-baseline">
                <span class="text-slate-400 font-medium">Режим работы:</span>
                <div class="sm:col-span-2 text-slate-800">
                  <div>Понедельник — пятница: с 09:00 до 18:00 (МСК)</div>
                  <div class="text-xs text-slate-500 mt-0.5">Суббота, воскресенье: выходные дни</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Аккуратный блок реквизитов под контактами -->
          <div class="mt-6 pt-5 border-t border-slate-100">
            <details class="group text-xs text-slate-600">
              <summary class="font-semibold text-slate-800 cursor-pointer list-none flex items-center justify-between hover:text-[#0093CB] transition-colors select-none">
                <span>Реквизиты организации</span>
                <span class="text-slate-400 group-open:rotate-180 transition-transform">▼</span>
              </summary>
              <div class="mt-3 pt-3 border-t border-slate-100 space-y-2 text-[11px] leading-relaxed">
                <div><span class="text-slate-400">Наименование:</span> ООО «Радиома оборудование связи и навигации»</div>
                <div><span class="text-slate-400">ИНН / КПП:</span> 7728148920 / 772801001</div>
                <div><span class="text-slate-400">ОГРН:</span> 1027700348210 &bull; <span class="text-slate-400">ОКПО:</span> 40284910</div>
              </div>
            </details>
          </div>
        </div>

        <!-- Правая часть: Интерактивная карта с отметкой офиса компании -->
        <div class="lg:col-span-7 bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm min-h-[380px] sm:min-h-[440px] relative">
          <iframe 
            src="https://yandex.ru/map-widget/v1/?ll=37.598185%2C55.759081&z=17&pt=37.598185%2C55.759081,pm2blm" 
            class="w-full h-full border-0 absolute inset-0"
            frameborder="0"
            allowfullscreen="true"
            title="Офис компании РАДИОМА — Москва, ул. Малая Бронная, д. 2, стр. 1"
          ></iframe>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const phone = '+7 (495) 725-6006'
const phoneRaw = '+74957256006'
const fax = '(495) 725-60-08'
const email = 'office@radioma.ru'
</script>

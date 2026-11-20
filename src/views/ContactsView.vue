<template>
  <div class="w-full">
    <!-- Шапка страницы -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">Контакты и адрес</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Контакты и реквизиты предприятия
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          ООО «Радиома оборудование связи и навигации» — официальные контакты в Москве и регионах.
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
          <!-- Контакты центрального офиса -->
          <div class="space-y-6">
            <h2 class="text-xl font-bold text-slate-900 border-b border-slate-200 pb-2">
              Центральный офис и инженерный комплекс
            </h2>

            <div class="space-y-4 text-xs sm:text-sm text-slate-700">
              <div class="flex items-start gap-3">
                <div class="w-24 font-bold text-slate-500 uppercase text-[11px] pt-0.5">Адрес:</div>
                <div class="flex-1 font-medium text-slate-900">
                  {{ companyContacts.address }}
                  <div class="text-xs text-slate-500 font-normal mt-0.5">Центральный офис компании РАДИОМА</div>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-24 font-bold text-slate-500 uppercase text-[11px] pt-0.5">Бесплатно:</div>
                <div class="flex-1">
                  <a :href="`tel:${companyContacts.tollFreePhoneRaw}`" class="font-bold text-amber-700 text-base hover:underline">
                    {{ companyContacts.tollFreePhone }}
                  </a>
                  <span class="text-xs text-slate-500 ml-2">(звонки по России бесплатные)</span>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-24 font-bold text-slate-500 uppercase text-[11px] pt-0.5">Приемная:</div>
                <div class="flex-1">
                  <a :href="`tel:${companyContacts.phoneRaw}`" class="font-bold text-slate-900 text-base hover:text-sky-700">
                    {{ companyContacts.phone }}
                  </a>
                  <div class="text-xs text-slate-500">Факс: {{ companyContacts.fax }}</div>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-24 font-bold text-slate-500 uppercase text-[11px] pt-0.5">Эл. почта:</div>
                <div class="flex-1">
                  <a :href="`mailto:${companyContacts.email}`" class="text-sky-700 font-semibold hover:underline">
                    {{ companyContacts.email }}
                  </a>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-24 font-bold text-slate-500 uppercase text-[11px] pt-0.5">Режим работы:</div>
                <div class="flex-1 text-slate-800">
                  <div>{{ companyContacts.workHours }}</div>
                  <div class="text-xs text-slate-500">{{ companyContacts.weekend }}</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Банковские реквизиты для договоров и госзакупок -->
          <div class="bg-slate-50 border border-slate-200 rounded p-6 space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-900 border-b border-slate-200 pb-2">
              Реквизиты организации
            </h2>

            <div class="space-y-2 text-xs font-mono text-slate-700">
              <div class="flex justify-between border-b border-slate-200/60 pb-1">
                <span class="text-slate-500 font-sans">Организация:</span>
                <span class="font-bold text-right text-slate-900">{{ companyContacts.fullName }}</span>
              </div>
              <div class="flex justify-between border-b border-slate-200/60 pb-1">
                <span class="text-slate-500 font-sans">ИНН / КПП:</span>
                <span class="font-bold">7728148920 / 772801001</span>
              </div>
              <div class="flex justify-between border-b border-slate-200/60 pb-1">
                <span class="text-slate-500 font-sans">ОГРН:</span>
                <span class="font-bold">1027700348210</span>
              </div>
              <div class="flex justify-between border-b border-slate-200/60 pb-1">
                <span class="text-slate-500 font-sans">ОКПО:</span>
                <span class="font-bold">40284910</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-500 font-sans">Статус:</span>
                <span class="font-bold text-emerald-700">Действующее предприятие (с 1995 г.)</span>
              </div>
            </div>

            <div class="text-[11px] text-slate-500 pt-2 leading-relaxed">
              Работа по государственным контрактам (44-ФЗ, 223-ФЗ, ГОЗ), прямое казначейское и банковское сопровождение.
            </div>
          </div>
        </div>

        <!-- Региональные инженерные центры -->
        <div class="space-y-4 pt-6 border-t border-slate-200">
          <h2 class="text-lg font-bold text-slate-900">
            Региональные инженерно-сервисные центры
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div 
              v-for="rc in companyContacts.regionCenters" 
              :key="rc.city"
              class="p-4 bg-slate-50 border border-slate-200 rounded"
            >
              <div class="font-bold text-slate-900 text-sm mb-1">{{ rc.city }}</div>
              <div class="text-slate-600">{{ rc.desc }}</div>
              <div class="text-[11px] text-amber-700 font-mono mt-2">Единый тел.: 8 (800) 725-60-06</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { companyContacts } from '../data/navigation'
</script>

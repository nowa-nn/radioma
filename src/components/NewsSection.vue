<template>
  <section id="news" class="w-full bg-slate-50 py-12 sm:py-16 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-8 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          Новости
        </h2>
        <p class="text-sm sm:text-base text-slate-600 mt-1.5 max-w-2xl">
          Хроника событий, сертификация оборудования и реализация проектов предприятия
        </p>
      </div>

      <!-- Список новостей: карточки на всю ширину сетки (w-full в max-w-7xl) -->
      <div class="w-full space-y-4">
        <article 
          v-for="item in visibleNews" 
          :key="item.id"
          class="bg-white border border-slate-200 rounded-sm p-4 sm:p-5 transition-colors hover:border-slate-300 shadow-[0_1px_3px_rgba(0,0,0,0.02)] w-full"
        >
          <!-- Дата публикации -->
          <div class="text-xs font-semibold text-slate-500 mb-1">
            {{ item.date }}
          </div>

          <!-- Название новости (ссылка на отдельную страницу) -->
          <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">
            <router-link :to="`/news/${item.id}`" class="hover:text-[#0093CB] transition-colors">
              {{ item.title }}
            </router-link>
          </h3>

          <!-- ДЕСКТОПНАЯ ВЕРСИЯ: сокращенная высота за счет перемещения «Читать полностью» на одну строку с текстом без нижней полосы -->
          <div class="hidden sm:block mt-1.5 text-xs sm:text-sm text-slate-600 leading-relaxed">
            <span v-if="item.textPreview">{{ item.textPreview }}</span>
            <router-link 
              :to="`/news/${item.id}`" 
              class="text-[#0093CB] hover:text-[#007EAF] font-semibold ml-2 whitespace-nowrap transition-colors inline-block"
            >
              Читать полностью
            </router-link>
          </div>

          <!-- МОБИЛЬНАЯ ВЕРСИЯ: дизайн оставлен БЕЗ ИЗМЕНЕНИЙ (текст + нижняя плашка с разделителем) -->
          <div class="sm:hidden">
            <p v-if="item.textPreview" class="text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed">
              {{ item.textPreview }}
            </p>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end">
              <router-link 
                :to="`/news/${item.id}`" 
                class="text-xs font-semibold text-[#0093CB] hover:text-[#007EAF] transition-colors"
              >
                Читать полностью
              </router-link>
            </div>
          </div>
        </article>
      </div>

      <!-- Кликабельный текст «Показать больше новостей» внизу блока -->
      <div v-if="newsList.length > 3" class="mt-6 pt-2">
        <button 
          type="button" 
          class="text-xs sm:text-sm font-semibold text-[#0093CB] hover:text-[#007EAF] transition-colors cursor-pointer underline-offset-4 hover:underline focus:outline-none"
          @click="showAll = !showAll"
        >
          {{ showAll ? 'Свернуть новости' : 'Показать больше новостей' }}
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import newsData from '../data/news.json'

const newsList = ref(newsData)
const showAll = ref(false)

// По умолчанию отображаются только три последние новости
const visibleNews = computed(() => {
  return showAll.value ? newsList.value : newsList.value.slice(0, 3)
})
</script>

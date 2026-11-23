<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Шапка сайта (на внутренней странице работает в белом фиксированном режиме) -->
    <TransparentHeader :force-solid="true" :variant="isFromClassic ? 'classic' : 'shape'" />

    <main class="flex-grow pt-28 sm:pt-36 pb-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Навигационные хлебные крошки (Breadcrumbs) -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 flex-wrap">
          <router-link :to="isFromClassic ? '/classic' : '/'" class="hover:text-slate-900 transition-colors">Главная</router-link>
          <span>/</span>
          <router-link :to="isFromClassic ? { path: '/classic', hash: '#directions' } : { path: '/', hash: '#directions' }" class="hover:text-slate-900 transition-colors">
            Направления деятельности
          </router-link>
          <span>/</span>
          <span class="text-slate-800 font-medium truncate max-w-xs sm:max-w-md">
            {{ direction ? direction.shortTitle : 'Загрузка...' }}
          </span>
        </nav>

        <!-- Состояние: Направление найдено -->
        <div v-if="direction" class="space-y-8">
          
          <!-- Главный баннер раздела с фотографией реального оборудования/объекта -->
          <div class="bg-white border border-slate-200 rounded-sm overflow-hidden shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
              <div 
                class="p-6 sm:p-10 flex flex-col justify-center"
                :class="direction.image ? 'lg:col-span-7 xl:col-span-8' : 'lg:col-span-12'"
              >
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight leading-tight mb-4">
                  {{ direction.title }}
                </h1>
                <p class="text-base sm:text-lg text-slate-700 leading-relaxed">
                  {{ direction.lead }}
                </p>
              </div>

              <!-- Фотография оборудования или морского/наземного объекта -->
              <div 
                v-if="direction.image" 
                class="lg:col-span-5 xl:col-span-4 relative min-h-[240px] sm:min-h-[280px] lg:min-h-full bg-slate-900 overflow-hidden border-t lg:border-t-0 lg:border-l border-slate-100"
              >
                <img 
                  :src="`${baseUrl}${direction.image}`" 
                  :alt="direction.title" 
                  class="w-full h-full object-cover object-center"
                />
                <div 
                  v-if="direction.imageCaption" 
                  class="absolute bottom-0 inset-x-0 bg-slate-950/85 backdrop-blur-xs text-[11px] text-slate-200 px-3.5 py-2 leading-snug border-t border-white/10"
                >
                  {{ direction.imageCaption }}
                </div>
              </div>
            </div>
          </div>

          <!-- Основная сетка: Детальный контент слева, Боковая панель справа -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Левая колонка (Контент) -->
            <div class="lg:col-span-8 space-y-8">
              
              <!-- 1. Профиль деятельности и опыт реализации -->
              <section class="bg-white border border-slate-200 rounded-sm p-6 sm:p-8 shadow-sm space-y-4">
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">
                  О направлении и опыте компании
                </h2>
                <div class="space-y-3.5 text-sm sm:text-base text-slate-700 leading-relaxed">
                  <p v-for="(paragraph, idx) in direction.overview" :key="idx">
                    {{ paragraph }}
                  </p>
                </div>
              </section>

              <!-- 2. Ключевые инженерные решения и компетенции -->
              <section class="bg-white border border-slate-200 rounded-sm p-6 sm:p-8 shadow-sm space-y-5">
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">
                  Инженерные решения и состав работ
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                  <div 
                    v-for="(item, idx) in direction.capabilities" 
                    :key="idx"
                    class="p-4 sm:p-5 bg-slate-50 border border-slate-200/90 rounded-sm space-y-2 hover:border-slate-300 transition-colors"
                  >
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-[#0093CB] flex-shrink-0"></span>
                      <h3 class="text-sm font-bold text-slate-900 leading-snug">
                        {{ item.title }}
                      </h3>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed pl-4">
                      {{ item.description }}
                    </p>
                  </div>
                </div>
              </section>

              <!-- 3. Номенклатура оборудования и аппаратуры -->
              <section class="bg-white border border-slate-200 rounded-sm p-6 sm:p-8 shadow-sm space-y-5">
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">
                  Применяемое оборудование и аппаратура
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                  <div 
                    v-for="(equip, idx) in direction.equipment" 
                    :key="idx"
                    class="p-5 border border-slate-200 rounded-sm flex flex-col justify-between hover:border-slate-300 transition-colors bg-white"
                  >
                    <div>
                      <h3 class="text-base font-bold text-slate-900">
                        {{ equip.name }}
                      </h3>
                      <div class="text-xs font-medium text-slate-500 mb-2">
                        {{ equip.type }}
                      </div>
                      <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ equip.description }}
                      </p>
                    </div>
                  </div>
                </div>
              </section>

              <!-- 4. Стандарты и нормативно-техническое соответствие -->
              <section class="bg-white border border-slate-200 rounded-sm p-6 sm:p-8 shadow-sm space-y-4">
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">
                  Нормативно-техническая база и сертификаты
                </h2>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-slate-700">
                  <li 
                    v-for="(cert, idx) in direction.certifications" 
                    :key="idx"
                    class="flex items-start gap-2.5 p-2.5 bg-slate-50 border border-slate-200/80 rounded-sm"
                  >
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium text-slate-800">{{ cert }}</span>
                  </li>
                </ul>
              </section>

              <!-- Нижняя панель возврата -->
              <div class="pt-4 flex items-center justify-between flex-wrap gap-4 border-t border-slate-200">
                <router-link 
                  :to="isFromClassic ? { path: '/classic', hash: '#directions' } : { path: '/', hash: '#directions' }" 
                  class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-[#0093CB] hover:text-[#007EAF] transition-colors"
                >
                  <span>←</span>
                  <span>Ко всем направлениям деятельности</span>
                </router-link>

                <span class="text-xs text-slate-400">
                  ООО «Радиома оборудование связи и навигации»
                </span>
              </div>
            </div>

            <!-- Правая боковая колонка (Sidebar) -->
            <aside class="lg:col-span-4 space-y-6">
              
              <!-- Карточка заказа и консультации -->
              <div class="bg-slate-900 text-white border border-slate-800 rounded-sm p-6 shadow-sm space-y-4">
                <h3 class="text-sm font-bold text-white tracking-tight">
                  Консультация и подбор оборудования
                </h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                  Инженеры ООО «Радиома» подготовят технико-коммерческое предложение под ваш флот или береговой объект, рассчитают радиопокрытие и согласуют комплектацию с Регистром.
                </p>

                <div class="space-y-2 pt-1 text-xs">
                  <div class="text-slate-400">Справочная служба:</div>
                  <a href="tel:+74957256006" class="block font-bold text-base text-white hover:text-[#7FD3F5] transition-colors">
                    +7 (495) 725-60-06
                  </a>
                  <div class="text-slate-400 pt-1">Электронная почта:</div>
                  <a href="mailto:office@radioma.ru" class="block font-semibold text-[#7FD3F5] hover:text-white transition-colors">
                    office@radioma.ru
                  </a>
                </div>

                <div class="pt-2">
                  <button 
                    type="button"
                    class="block w-full text-center bg-[#0093CB] hover:bg-[#007EAF] active:bg-[#006B95] text-white text-xs font-semibold py-3 px-4 rounded-sm transition-colors cursor-pointer shadow-sm"
                    @click="isModalOpen = true"
                  >
                    Запросить коммерческое предложение
                  </button>
                </div>
              </div>

              <!-- Другие направления (быстрая навигация) -->
              <div class="bg-white border border-slate-200 rounded-sm p-6 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900 border-b border-slate-100 pb-2.5">
                  Другие направления
                </h3>
                <ul class="space-y-2 text-xs">
                  <li v-for="item in otherDirections" :key="item.id">
                    <router-link 
                      :to="{ path: `/directions/${item.id}`, query: isFromClassic ? { from: 'classic' } : {} }"
                      class="text-slate-700 hover:text-[#0093CB] transition-colors flex items-center justify-between group py-1"
                    >
                      <span class="group-hover:translate-x-0.5 transition-transform line-clamp-1">
                        {{ item.sidebarTitle || item.shortTitle }}
                      </span>
                      <span class="text-slate-400 group-hover:text-[#0093CB] transition-colors ml-2">→</span>
                    </router-link>
                  </li>
                </ul>
              </div>

            </aside>
          </div>
        </div>

        <!-- Состояние: Направление не найдено (404) -->
        <div v-else class="bg-white border border-slate-200 rounded-sm p-10 text-center space-y-4">
          <h2 class="text-xl font-bold text-slate-900">Раздел не найден</h2>
          <p class="text-sm text-slate-600 max-w-md mx-auto">
            Запрошенное направление деятельности не найдено или адрес был изменен.
          </p>
          <div class="pt-2">
            <router-link 
              :to="{ path: '/', hash: '#directions' }" 
              class="inline-block bg-[#0093CB] hover:bg-[#007EAF] text-white text-xs font-semibold px-5 py-2.5 rounded-sm transition-colors"
            >
              Вернуться к направлениям
            </router-link>
          </div>
        </div>

      </div>
    </main>

    <!-- Попап обратной связи для запроса коммерческого предложения -->
    <FeedbackModal 
      v-model="isModalOpen" 
      :subject="direction ? direction.title : ''" 
    />

    <!-- Подвал сайта -->
    <FooterSection />
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import TransparentHeader from '../components/TransparentHeader.vue'
import FooterSection from '../components/FooterSection.vue'
import FeedbackModal from '../components/FeedbackModal.vue'
import directionsData from '../data/directions.json'

const baseUrl = import.meta.env.BASE_URL
const route = useRoute()
const isModalOpen = ref(false)

const isFromClassic = computed(() => {
  return route.query.from === 'classic' || route.query.variant === 'classic' || route.path.includes('classic')
})

const directionId = computed(() => route.params.id)

const direction = computed(() => {
  return directionsData.find(item => item.id === directionId.value) || null
})

const otherDirections = computed(() => {
  return directionsData.filter(item => item.id !== directionId.value)
})

// Прокрутка наверх при переключении между направлениями
watch(() => route.params.id, () => {
  window.scrollTo({ top: 0, behavior: 'smooth' })
})

onMounted(() => {
  window.scrollTo({ top: 0 })
})
</script>

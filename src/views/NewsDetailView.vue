<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Шапка сайта (на внутренней странице автоматически работает в белом солидном режиме) -->
    <TransparentHeader :force-solid="true" />

    <main class="flex-grow pt-24 sm:pt-28 pb-16">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Навигационные хлебные крошки (Breadcrumbs) -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 flex-wrap">
          <router-link to="/" class="hover:text-slate-900 transition-colors">Главная</router-link>
          <span>/</span>
          <router-link to="/#news" class="hover:text-slate-900 transition-colors">Новости</router-link>
          <span>/</span>
          <span class="text-slate-800 font-medium truncate max-w-xs sm:max-w-md">
            {{ article ? article.title : 'Загрузка...' }}
          </span>
        </nav>

        <!-- Состояние: Новость найдена -->
        <article v-if="article" class="bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden">
          <!-- Шапка статьи -->
          <div class="p-6 sm:p-10 border-b border-slate-100">
            <time class="text-xs sm:text-sm font-semibold text-slate-500 block mb-2">
              {{ article.date }}
            </time>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
              {{ article.title }}
            </h1>
          </div>

          <!-- Основное тело статьи со старого сайта (единый шаблон для интеграции с Directus CMS) -->
          <div class="p-6 sm:p-10 text-sm sm:text-base text-slate-700 leading-relaxed news-article-content">
            <div v-html="formattedHtml"></div>
          </div>

          <!-- Подвал статьи с кнопкой возврата -->
          <div class="p-6 sm:px-10 py-5 bg-slate-50/70 border-t border-slate-200/80 flex items-center justify-between flex-wrap gap-4">
            <router-link 
              to="/#news" 
              class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-sky-700 hover:text-sky-900 transition-colors"
            >
              <span>←</span>
              <span>Ко всем новостям</span>
            </router-link>

            <span class="text-xs text-slate-400">
              Архив публикаций ООО «Радиома»
            </span>
          </div>
        </article>

        <!-- Состояние: Новость не найдена (404) -->
        <div v-else class="bg-white border border-slate-200 rounded-sm p-10 text-center space-y-4">
          <h2 class="text-xl font-bold text-slate-900">Новость не найдена</h2>
          <p class="text-sm text-slate-600 max-w-md mx-auto">
            Запрошенная публикация не найдена или была перемещена в архив.
          </p>
          <div class="pt-2">
            <router-link 
              to="/#news" 
              class="inline-block bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold px-5 py-2.5 rounded-sm transition-colors"
            >
              Вернуться к новостям
            </router-link>
          </div>
        </div>
      </div>
    </main>

    <!-- Подвал сайта -->
    <FooterSection />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import TransparentHeader from '../components/TransparentHeader.vue'
import FooterSection from '../components/FooterSection.vue'
import newsData from '../data/news.json'

const route = useRoute()
const articleId = computed(() => Number(route.params.id))
const baseUrl = import.meta.env.BASE_URL

// Единая точка доступа к данным: в будущем заменяется на запрос к Directus API:
// const { data: article } = await directus.items('news').readOne(articleId.value)
const article = computed(() => {
  return newsData.find(item => item.id === articleId.value) || null
})

const formattedHtml = computed(() => {
  if (!article.value) return ''
  return article.value.cleanHtml.replace(/\/images\/news\//g, `${baseUrl}images/news/`)
})
</script>

<style>
.news-article-content p {
  margin-bottom: 1rem;
  line-height: 1.68;
}

.news-article-content strong {
  color: #0f172a;
}

.news-article-content ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}

.news-article-content img {
  display: block;
  max-width: 100%;
  height: auto;
  margin-top: 1.5rem;
  margin-bottom: 1.5rem;
  border-radius: 0.125rem;
  border: 1px solid #e2e8f0;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}
</style>

<template>
  <div class="w-full">
    <!-- Шапка страницы -->
    <div class="bg-[#0b1f33] text-white py-8 border-b border-slate-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-mono">
          <router-link to="/" class="hover:text-amber-400">Главная</router-link>
          <span>/</span>
          <span class="text-amber-400 font-semibold">Новости и испытания</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Новости, разработки и испытания
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl font-mono">
          Хроника натурных испытаний техники, ввод в эксплуатацию ведомственных систем и новинки оборудования.
        </p>
      </div>
    </div>

    <!-- Основной контент -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
      <div class="bg-white rounded border border-slate-200 shadow-sm p-6 sm:p-10 space-y-8">
        
        <div class="space-y-6 divide-y divide-slate-200">
          <article 
            v-for="(post, idx) in newsArticles" 
            :key="post.id"
            :class="{ 'pt-6': idx > 0 }"
            class="space-y-3"
          >
            <div class="flex items-center gap-3 text-xs text-slate-500 font-mono">
              <span class="text-amber-700 font-bold">{{ post.date }}</span>
              <span>•</span>
              <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-700 font-medium font-sans">
                {{ post.category }}
              </span>
            </div>

            <h2 class="text-lg sm:text-xl font-bold text-slate-900 leading-snug">
              {{ post.title }}
            </h2>

            <p class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
              {{ post.summary }}
            </p>

            <div class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded border border-slate-200">
              {{ post.content.trim() }}
            </div>
          </article>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { newsArticles } from '../data/news'
</script>

<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Классический белый закрепленный хедер -->
    <TransparentHeader variant="classic" />

    <main class="flex-grow pt-14 sm:pt-16">
      <!-- 1. Первый экран (HeroSlider на всю высоту экрана за вычетом хедера) -->
      <HeroSlider :is-transparent="false" variant="classic" />

      <!-- 2. Направления деятельности (#directions) -->
      <NavigationCards variant="classic" />

      <!-- 3. Блок Новости (#news) -->
      <NewsSection />

      <!-- 4. О компании (#about) -->
      <AboutSection variant="classic" />

      <!-- 5. Контакты и реквизиты (#contacts) -->
      <ContactsSection />
    </main>

    <!-- Подвал сайта -->
    <FooterSection />
  </div>
</template>

<script setup>
import TransparentHeader from '../components/TransparentHeader.vue'
import HeroSlider from '../components/HeroSlider.vue'
import NavigationCards from '../components/NavigationCards.vue'
import NewsSection from '../components/NewsSection.vue'
import AboutSection from '../components/AboutSection.vue'
import ContactsSection from '../components/ContactsSection.vue'
import FooterSection from '../components/FooterSection.vue'
</script>

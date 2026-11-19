<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Закрепленный прозрачный хедер -->
    <TransparentHeader />

    <main class="flex-grow">
      <!-- Первый экран со слайдером -->
      <HeroSlider :is-transparent="true" />

      <!-- Блок навигации по направлениям -->
      <NavigationCards />

      <!-- Блок Новости -->
      <NewsSection />

      <!-- О компании -->
      <AboutSection />

      <!-- Контакты и реквизиты -->
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

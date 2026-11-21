<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Классический закрепленный прозрачный хедер без синей подложки, с увеличенной высотой и логотипом из logo-photoroom, меняющим цвет при скролле -->
    <TransparentHeader variant="classic" />

    <main class="flex-grow">
      <!-- 1. Первый экран (HeroSlider на всю высоту экрана) -->
      <HeroSlider :is-transparent="true" />

      <!-- 2. Направления деятельности (#directions) -->
      <NavigationCards />

      <!-- 3. Блок Новости (#news) -->
      <NewsSection />

      <!-- 4. О компании (#about) -->
      <AboutSection />

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

<template>
  <div class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900 flex flex-col relative">
    <!-- Непрозрачный белый хедер с увеличенным контрастным меню и свисающим шейпом с логотипом -->
    <TransparentHeader :force-solid="true" />

    <main class="flex-grow pt-12 sm:pt-14">
      <!-- Компактный первый экран: занимает ровно половину высоты экрана (50vh) -->
      <HeroSlider :is-transparent="false" :is-half-height="true" />

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

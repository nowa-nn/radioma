<template>
  <section id="about" class="w-full bg-slate-50 py-12 sm:py-16 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Заголовок раздела -->
      <div class="mb-8 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
          О компании
        </h2>
      </div>

      <!-- Сетка: Текст слева, Свидетельство строго одной высоты с текстом справа на десктопе -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        <!-- Левая колонка: Достоверная информация о профиле и опыте компании -->
        <div ref="textBlockRef" class="lg:col-span-8 space-y-4 text-sm sm:text-base text-slate-700 leading-relaxed">
          <p>
            Компания <strong>ООО «Радиома оборудование связи и навигации»</strong> с момента своего основания в <strong>1995 году</strong> специализируется на комплексных поставках, оснащении и сервисном обслуживании аппаратуры радиосвязи и навигационного оборудования для морского и речного флота, береговых служб и ведомственных объектов.
          </p>
          <p>
            За более чем 30 лет деятельности компания реализовала сотни проектов — от оснащения береговых систем безопасности судоходства на Балтийском и Черном морях до постов связи в акватории СМП и речных бассейнов Сибири и Дальнего Востока.
          </p>
          <p>
            Компания является признанным изготовителем радио- и навигационного оборудования (Свидетельство о признании Российского Морского Регистра Судоходства), поставляя проверенную аппаратуру под зарегистрированными торговыми марками <strong>«РАДИОМА»</strong> и <strong>«САНТЕЙ МОБАЙЛ»</strong> с обеспечением пусконаладочных работ, гарантийного и сервисного сопровождения.
          </p>
        </div>

        <!-- Правая колонка: Изображение сертификата (без подложки, высота равна тексту) -->
        <div class="lg:col-span-4 flex items-center justify-start lg:justify-end">
          <img 
            :src="`${baseUrl}certificate-2017.jpg`" 
            alt="Свидетельство о признании изготовителя 2017" 
            :style="isDesktop && textHeight ? { height: `${textHeight}px` } : {}"
            class="w-auto object-contain max-h-[380px] lg:max-h-none"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const baseUrl = import.meta.env.BASE_URL
const textBlockRef = ref(null)
const textHeight = ref(0)
const isDesktop = ref(false)
let resizeObserver = null

function updateHeight() {
  if (typeof window === 'undefined') return
  isDesktop.value = window.innerWidth >= 1024
  if (textBlockRef.value && isDesktop.value) {
    textHeight.value = textBlockRef.value.clientHeight
  } else {
    textHeight.value = 0
  }
}

onMounted(() => {
  updateHeight()
  if (window.ResizeObserver && textBlockRef.value) {
    resizeObserver = new ResizeObserver(() => {
      updateHeight()
    })
    resizeObserver.observe(textBlockRef.value)
  }
  window.addEventListener('resize', updateHeight)
})

onUnmounted(() => {
  if (resizeObserver) {
    resizeObserver.disconnect()
  }
  window.removeEventListener('resize', updateHeight)
})
</script>

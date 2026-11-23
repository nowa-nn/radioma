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
          <!-- Текст для варианта classic -->
          <template v-if="isClassic">
            <p>
              <strong>Компания РАДИОМА</strong> с момента своего основания в <strong>1995 году</strong> специализируется на комплексных поставках, проектировании, оснащении и сервисном обслуживании аппаратуры радиосвязи и навигационного оборудования для морского и речного флота, береговой инфраструктуры и ведомственных сетей связи. За историю предприятия с 1995 года действовало несколько юридических лиц, однако РАДИОМА всегда оставалась единой компанией с непрерывным инженерным опытом, собственными разработками и неизменными стандартами надежности.
            </p>
            <p>
              За все время успешной реализации проектов с 1995 года, группа компаний РАДИОМА спроектировала, реализовала и технически сопроводила сотни системных разработок с самой широкой географией внедрения – от Калининграда до побережья Камчатки, от Арктики до акватории Черного и Каспийского моря.
            </p>
            <p>
              Компания РАДИОМА является признанным изготовителем радио- и навигационного оборудования (Свидетельство о признании Российского Морского Регистра Судоходства), поставляя проверенную аппаратуру под зарегистрированными торговыми марками <strong>«РАДИОМА»</strong> и <strong>«САНТЕЙ МОБАЙЛ»</strong> с обеспечением пусконаладочных работ, гарантийного и сервисного сопровождения.
            </p>
          </template>

          <!-- Стандартный текст -->
          <template v-else>
            <p>
              <strong>Компания РАДИОМА</strong> с момента своего основания в <strong>1995 году</strong> специализируется на комплексных поставках, проектировании, оснащении и сервисном обслуживании аппаратуры радиосвязи и навигационного оборудования для морского и речного флота, береговых служб и ведомственных объектов. За историю предприятия с 1995 года действовало несколько юридических лиц, однако РАДИОМА всегда оставалась единой компанией с непрерывным инженерным опытом, собственными разработками и неизменными стандартами надежности.
            </p>
            <p>
              За более чем 30 лет деятельности компания реализовала сотни ответственных проектов — от оснащения береговых систем безопасности мореплавания на Балтийском и Черном морях до постов связи в акватории СМП и речных бассейнов Сибири и Дальнего Востока.
            </p>
            <p>
              Компания РАДИОМА является признанным изготовителем радио- и навигационного оборудования (Свидетельство о признании Российского Морского Регистра Судоходства), поставляя проверенную аппаратуру под зарегистрированными торговыми марками <strong>«РАДИОМА»</strong> и <strong>«САНТЕЙ МОБАЙЛ»</strong> с обеспечением пусконаладочных работ, гарантийного и сервисного сопровождения.
            </p>
          </template>
        </div>

        <!-- Правая колонка: Изображение сертификата (по центру на мобайле, по правому краю на десктопе) -->
        <div class="lg:col-span-4 flex items-center justify-center lg:justify-end w-full">
          <img 
            :src="`${baseUrl}certificate-2017.jpg`" 
            alt="Свидетельство о признании изготовителя 2017" 
            width="719"
            height="1024"
            :style="isDesktop && textHeight ? { height: `${textHeight}px` } : {}"
            class="w-auto aspect-[719/1024] object-contain max-h-[380px] lg:max-h-none mx-auto lg:mx-0 shadow-sm border border-slate-200 rounded-sm"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

const props = defineProps({
  variant: {
    type: String,
    default: ''
  }
})

const route = useRoute()
const isClassic = computed(() => {
  return props.variant === 'classic' || route?.path?.startsWith('/classic') || (typeof window !== 'undefined' && window.location.pathname.includes('classic'))
})

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

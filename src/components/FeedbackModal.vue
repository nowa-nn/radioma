<template>
  <teleport to="body">
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div 
        v-if="modelValue" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
      >
        <!-- Затемняющий фон (backdrop) -->
        <div 
          class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity"
          @click="closeModal"
        ></div>

        <!-- Тело модального окна -->
        <div 
          class="relative w-full max-w-lg bg-white border border-slate-200 rounded-sm shadow-2xl p-6 sm:p-8 z-10 my-8 transition-all"
          @click.stop
        >
          <!-- Кнопка закрытия (крестик) -->
          <button 
            type="button" 
            class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 p-1 rounded transition-colors cursor-pointer"
            aria-label="Закрыть"
            @click="closeModal"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Состояние 1: Форма заявки -->
          <div v-if="!isSubmitted">
            <div class="mb-5 pr-6">
              <h3 id="modal-title" class="text-xl font-bold text-slate-900 leading-snug">
                {{ title || (subject ? 'Запрос коммерческого предложения' : 'Связаться с нами') }}
              </h3>
              <p v-if="subject" class="text-xs text-slate-500 mt-1 leading-relaxed">
                Направление: <span class="font-medium text-slate-700">{{ subject }}</span>
              </p>
            </div>

            <form @submit.prevent="handleSubmit" class="space-y-4" novalidate>
              <!-- Поле: Имя -->
              <div>
                <label for="feedback-name" class="block text-xs font-semibold text-slate-700 mb-1">
                  Ваше имя <span class="text-red-500">*</span>
                </label>
                <input 
                  id="feedback-name"
                  v-model.trim="form.name"
                  type="text" 
                  placeholder="Иван Иванов"
                  class="w-full px-3.5 py-2.5 text-sm bg-white border rounded-sm outline-none transition-colors"
                  :class="errors.name ? 'border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-500' : 'border-slate-300 focus:border-[#0093CB] focus:ring-1 focus:ring-[#0093CB]'"
                  @input="clearError('name')"
                />
                <p v-if="errors.name" class="text-xs text-red-600 mt-1">
                  {{ errors.name }}
                </p>
              </div>

              <!-- Поле: Телефон (с маской и валидацией) -->
              <div>
                <label for="feedback-phone" class="block text-xs font-semibold text-slate-700 mb-1">
                  Номер телефона <span class="text-red-500">*</span>
                </label>
                <input 
                  id="feedback-phone"
                  v-model="form.phone"
                  type="tel" 
                  placeholder="+7 (___) ___-__-__"
                  class="w-full px-3.5 py-2.5 text-sm bg-white border rounded-sm outline-none transition-colors font-mono"
                  :class="errors.phone ? 'border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-500' : 'border-slate-300 focus:border-[#0093CB] focus:ring-1 focus:ring-[#0093CB]'"
                  @input="onPhoneInput"
                  @focus="onPhoneFocus"
                />
                <p v-if="errors.phone" class="text-xs text-red-600 mt-1">
                  {{ errors.phone }}
                </p>
              </div>

              <!-- Чекбокс: Согласие на обработку персональных данных (не отмечен по умолчанию) -->
              <div class="pt-1">
                <label class="flex items-start gap-2.5 cursor-pointer select-none">
                  <input 
                    v-model="form.consent" 
                    type="checkbox" 
                    class="mt-1 h-4 w-4 rounded-sm border-slate-300 text-[#0093CB] focus:ring-[#0093CB] cursor-pointer"
                    @change="clearError('consent')"
                  />
                  <span class="text-xs text-slate-600 leading-relaxed">
                    я даю согласие на обработку моих персональных данных в соотвествии с политикой конфиденциальности <span class="text-red-500">*</span>
                  </span>
                </label>
                <p v-if="errors.consent" class="text-xs text-red-600 mt-1 pl-6">
                  {{ errors.consent }}
                </p>
              </div>

              <!-- Кнопка отправки формы -->
              <div class="pt-3">
                <button 
                  type="submit"
                  :disabled="isSubmitting"
                  class="w-full bg-[#0093CB] hover:bg-[#007EAF] active:bg-[#006B95] text-white text-sm font-semibold py-3 px-4 rounded-sm transition-colors duration-150 disabled:opacity-60 cursor-pointer shadow-sm"
                >
                  <span v-if="isSubmitting">Отправка запроса...</span>
                  <span v-else>Отправить запрос</span>
                </button>
              </div>

              <p class="text-[11px] text-slate-400 text-center leading-tight pt-1">
                Инженеры ООО «Радиома» свяжутся с вами для уточнения состава оборудования и расчета сметы.
              </p>
            </form>
          </div>

          <!-- Состояние 2: Подтверждение успешной отправки -->
          <div v-else class="text-center py-6 space-y-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
              </svg>
            </div>

            <div class="space-y-1.5">
              <h3 class="text-xl font-bold text-slate-900">
                Заявка успешно отправлена!
              </h3>
              <p class="text-xs sm:text-sm text-slate-600 max-w-sm mx-auto leading-relaxed">
                Спасибо, <strong>{{ form.name }}</strong>! Наши специалисты подготовят технико-коммерческое предложение и свяжутся с вами по номеру <span class="font-mono font-medium text-slate-800">{{ form.phone }}</span> в ближайшее рабочее время.
              </p>
            </div>

            <div class="pt-3">
              <button 
                type="button" 
                class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold px-6 py-2.5 rounded-sm transition-colors cursor-pointer"
                @click="closeModal"
              >
                Закрыть
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </teleport>
</template>

<script setup>
import { ref, reactive, watch, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  modelValue: {
    type: Boolean,
    default: false
  },
  title: {
    type: String,
    default: ''
  },
  subject: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const isSubmitted = ref(false)
const isSubmitting = ref(false)

const form = reactive({
  name: '',
  phone: '',
  consent: false // Строго не отмечен по умолчанию согласно требованию
})

const errors = reactive({
  name: '',
  phone: '',
  consent: ''
})

function clearError(field) {
  if (errors[field]) {
    errors[field] = ''
  }
}

// Маска номера телефона: +7 (XXX) XXX-XX-XX
function formatPhone(value) {
  if (!value) return ''
  // Оставляем только цифры
  let digits = value.replace(/\D/g, '')

  // Если первая цифра 7 или 8, отсекаем её, чтобы оставить 10 цифр номера
  if (digits.startsWith('7') || digits.startsWith('8')) {
    digits = digits.substring(1)
  }

  // Ограничиваем 10 цифрами
  digits = digits.substring(0, 10)

  let formatted = '+7'
  if (digits.length > 0) {
    formatted += ' (' + digits.substring(0, 3)
  }
  if (digits.length >= 3) {
    formatted += ') ' + digits.substring(3, 6)
  }
  if (digits.length >= 6) {
    formatted += '-' + digits.substring(6, 8)
  }
  if (digits.length >= 8) {
    formatted += '-' + digits.substring(8, 10)
  }

  return formatted
}

function onPhoneInput(e) {
  const formatted = formatPhone(e.target.value)
  form.phone = formatted
  clearError('phone')
}

function onPhoneFocus() {
  if (!form.phone) {
    form.phone = '+7 ('
  }
}

function validate() {
  let valid = true
  errors.name = ''
  errors.phone = ''
  errors.consent = ''

  // Валидация имени
  if (!form.name || form.name.trim().length < 2) {
    errors.name = 'Пожалуйста, укажите ваше имя (не менее 2 символов)'
    valid = false
  }

  // Валидация телефона (должно быть 10 цифр после +7)
  const digits = form.phone.replace(/\D/g, '')
  // Полный номер: 7/8 + 10 цифр = 11 цифр
  if (digits.length < 11) {
    errors.phone = 'Укажите полный номер телефона: +7 (___) ___-__-__'
    valid = false
  }

  // Валидация согласия на обработку персональных данных
  if (!form.consent) {
    errors.consent = 'Необходимо дать согласие на обработку персональных данных'
    valid = false
  }

  return valid
}

function handleSubmit() {
  if (!validate()) {
    return
  }

  isSubmitting.value = true

  // Имитация отправки формы на сервер (в будущем интеграция с Directus/CRM)
  setTimeout(() => {
    isSubmitting.value = false
    isSubmitted.value = true
  }, 400)
}

function closeModal() {
  emit('update:modelValue', false)
  // Сброс через задержку анимации
  setTimeout(() => {
    isSubmitted.value = false
    form.name = ''
    form.phone = ''
    form.consent = false
    errors.name = ''
    errors.phone = ''
    errors.consent = ''
  }, 200)
}

function onKeyDown(e) {
  if (e.key === 'Escape' && props.modelValue) {
    closeModal()
  }
}

watch(() => props.modelValue, (isOpen) => {
  if (isOpen) {
    document.body.style.overflow = 'hidden'
  } else {
    document.body.style.overflow = ''
  }
})

onMounted(() => {
  window.addEventListener('keydown', onKeyDown)
})

onUnmounted(() => {
  window.removeEventListener('keydown', onKeyDown)
  document.body.style.overflow = ''
})
</script>

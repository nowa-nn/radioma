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
                  @keydown="onPhoneKeyDown"
                  @focus="onPhoneFocus"
                  @blur="onPhoneBlur"
                />
                <p v-if="errors.phone" class="text-xs text-red-600 mt-1">
                  {{ errors.phone }}
                </p>
              </div>

              <!-- Поле: Проверка от спам-ботов (Каптча) -->
              <div>
                <label for="feedback-captcha" class="block text-xs font-semibold text-slate-700 mb-1">
                  Защита от автоматического спама <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center gap-2.5">
                  <!-- Блок с математическим выражением -->
                  <div 
                    class="flex items-center gap-2 px-3 py-2 bg-slate-100 border rounded-sm font-mono text-sm font-bold select-none tracking-wider transition-colors"
                    :class="errors.captcha ? 'border-red-400 bg-red-50/50 text-red-900' : 'border-slate-300 text-slate-800'"
                    title="Решите простой пример для подтверждения"
                  >
                    <span>{{ captchaNum1 }} + {{ captchaNum2 }} =</span>
                    <button 
                      type="button" 
                      class="text-slate-400 hover:text-slate-700 focus:outline-none transition-colors p-0.5 cursor-pointer" 
                      title="Обновить контрольный пример"
                      aria-label="Обновить контрольный пример"
                      @click="refreshCaptcha"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                      </svg>
                    </button>
                  </div>

                  <!-- Поле ввода ответа -->
                  <div class="flex-1">
                    <input 
                      id="feedback-captcha"
                      v-model.trim="form.captcha"
                      type="text" 
                      inputmode="numeric"
                      placeholder="Ответ"
                      class="w-full px-3.5 py-2 text-sm bg-white border rounded-sm outline-none transition-colors font-mono"
                      :class="errors.captcha ? 'border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-500 bg-red-50/20' : 'border-slate-300 focus:border-[#0093CB] focus:ring-1 focus:ring-[#0093CB]'"
                      @input="clearError('captcha')"
                    />
                  </div>
                </div>
                <p v-if="errors.captcha" class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                  <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ errors.captcha }}</span>
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

              <!-- Скрытое поле защиты от спам-ботов (Honeypot) -->
              <input 
                type="text" 
                v-model="form.honeypot" 
                tabindex="-1" 
                autocomplete="off" 
                class="hidden opacity-0 absolute -z-10 pointer-events-none" 
                aria-hidden="true" 
              />

              <!-- Сообщение об ошибке отправки (если сервер вернул ошибку) -->
              <div v-if="submitError" class="p-3 bg-red-50 border border-red-200 rounded-sm text-xs text-red-700 leading-relaxed flex items-start gap-2">
                <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ submitError }}</span>
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
const submitError = ref('')

const captchaNum1 = ref(4)
const captchaNum2 = ref(7)

function generateCaptcha(resetError = true) {
  captchaNum1.value = Math.floor(Math.random() * 8) + 2
  captchaNum2.value = Math.floor(Math.random() * 8) + 1
  form.captcha = ''
  if (resetError) {
    clearError('captcha')
  }
}

function refreshCaptcha() {
  generateCaptcha(true)
}

const form = reactive({
  name: '',
  phone: '',
  captcha: '',
  consent: false, // Строго не отмечен по умолчанию согласно требованию
  honeypot: ''
})

const errors = reactive({
  name: '',
  phone: '',
  captcha: '',
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
  let rawDigits = value.replace(/\D/g, '')
  if (rawDigits.length === 0) return ''

  let nationalDigits = ''
  if (rawDigits.startsWith('7') || rawDigits.startsWith('8')) {
    nationalDigits = rawDigits.substring(1, 11)
    if (nationalDigits.length === 0) {
      return '+7 ('
    }
  } else {
    nationalDigits = rawDigits.substring(0, 10)
  }

  let formatted = '+7 (' + nationalDigits.substring(0, 3)
  if (nationalDigits.length >= 3) {
    formatted += ') ' + nationalDigits.substring(3, 6)
  }
  if (nationalDigits.length >= 6) {
    formatted += '-' + nationalDigits.substring(6, 8)
  }
  if (nationalDigits.length >= 8) {
    formatted += '-' + nationalDigits.substring(8, 10)
  }

  return formatted
}

// Обработка клавиш Backspace / Delete: удаление предшествующей цифры при курсоре после символа маски (- , ) , пробел)
function onPhoneKeyDown(e) {
  const input = e.target
  const key = e.key

  if (key === 'Backspace') {
    const start = input.selectionStart
    const end = input.selectionEnd

    // Если выделен фрагмент текста, браузер штатно удалит выделение
    if (start !== end) return

    // Если курсор в начале поля или на префиксе '+7 (', очищаем поле
    if (start <= 4) {
      if (start > 0) {
        e.preventDefault()
        form.phone = ''
        clearError('phone')
      }
      return
    }

    // Символ непосредственно перед курсором
    const charBefore = input.value[start - 1]

    // Если перед курсором разделитель маски ('-', ' ', ')')
    if (/\D/.test(charBefore)) {
      e.preventDefault()

      // Ищем ближайшую цифру слева
      let lastDigitIdx = -1
      for (let i = start - 1; i >= 0; i--) {
        if (/\d/.test(input.value[i])) {
          if (i <= 1) break // Пропускаем ведущую 7 в '+7'
          lastDigitIdx = i
          break
        }
      }

      if (lastDigitIdx > 1) {
        // Удаляем именно эту найденную цифру
        const raw = input.value.slice(0, lastDigitIdx) + input.value.slice(lastDigitIdx + 1)
        const formatted = formatPhone(raw)
        form.phone = formatted
        clearError('phone')

        requestAnimationFrame(() => {
          const isAtEnd = start >= input.value.length
          const targetPos = isAtEnd ? formatted.length : Math.min(lastDigitIdx, formatted.length)
          input.setSelectionRange(targetPos, targetPos)
        })
      } else {
        form.phone = ''
        clearError('phone')
      }
    }
  } else if (key === 'Delete') {
    const start = input.selectionStart
    const end = input.selectionEnd
    if (start !== end) return

    if (start < input.value.length) {
      const charAfter = input.value[start]
      if (/\D/.test(charAfter)) {
        e.preventDefault()
        let nextDigitIdx = -1
        for (let i = start; i < input.value.length; i++) {
          if (/\d/.test(input.value[i])) {
            nextDigitIdx = i
            break
          }
        }
        if (nextDigitIdx !== -1) {
          const raw = input.value.slice(0, nextDigitIdx) + input.value.slice(nextDigitIdx + 1)
          const formatted = formatPhone(raw)
          form.phone = formatted
          clearError('phone')
          requestAnimationFrame(() => {
            const targetPos = Math.min(start, formatted.length)
            input.setSelectionRange(targetPos, targetPos)
          })
        }
      }
    }
  }
}

function onPhoneInput(e) {
  const input = e.target
  const val = input.value
  const prevPos = input.selectionStart
  const wasAtEnd = prevPos === null || prevPos >= val.length - 1

  const formatted = formatPhone(val)
  form.phone = formatted
  clearError('phone')

  requestAnimationFrame(() => {
    if (input === document.activeElement) {
      if (wasAtEnd || !prevPos) {
        input.setSelectionRange(formatted.length, formatted.length)
      } else {
        const diff = formatted.length - val.length
        const newPos = Math.min(Math.max(prevPos + diff, 4), formatted.length)
        input.setSelectionRange(newPos, newPos)
      }
    }
  })
}

function onPhoneFocus(e) {
  if (!form.phone) {
    form.phone = '+7 ('
  }
  requestAnimationFrame(() => {
    const input = e.target
    if (input === document.activeElement) {
      input.setSelectionRange(form.phone.length, form.phone.length)
    }
  })
}

function onPhoneBlur() {
  if (form.phone === '+7 (' || form.phone === '+7') {
    form.phone = ''
  }
}

function validate() {
  let valid = true
  errors.name = ''
  errors.phone = ''
  errors.captcha = ''
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

  // Валидация каптчи
  if (!form.captcha || form.captcha.trim() === '') {
    errors.captcha = 'Пожалуйста, укажите ответ на контрольный пример'
    valid = false
  } else {
    const expected = captchaNum1.value + captchaNum2.value
    if (parseInt(form.captcha, 10) !== expected) {
      errors.captcha = 'Неверный ответ на контрольный пример. Попробуйте еще раз.'
      // Обновляем пример, сохраняя ошибку на экране
      generateCaptcha(false)
      valid = false
    }
  }

  // Валидация согласия на обработку персональных данных
  if (!form.consent) {
    errors.consent = 'Необходимо дать согласие на обработку персональных данных'
    valid = false
  }

  return valid
}

async function handleSubmit() {
  if (!validate()) {
    return
  }

  isSubmitting.value = true
  submitError.value = ''

  try {
    const payload = {
      name: form.name.trim(),
      phone: form.phone.trim(),
      subject: props.subject || props.title || 'Запрос с сайта',
      pageUrl: typeof window !== 'undefined' ? window.location.href : '',
      honeypot: form.honeypot || ''
    }

    // В dev-режиме локального сервера эмулируем отправку
    if (import.meta.env.DEV) {
      console.log('[DEV mode] Отправка заявки на office@radioma.ru:', payload)
      await new Promise(resolve => setTimeout(resolve, 600))
      isSubmitting.value = false
      isSubmitted.value = true
      return
    }

    const mailEndpoint = `${import.meta.env.BASE_URL || '/'}mail.php`.replace('//', '/')
    const response = await fetch(mailEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)
    })

    const data = await response.json().catch(() => null)

    if (response.ok && data && data.success) {
      isSubmitted.value = true
    } else {
      submitError.value = (data && data.error)
        ? data.error
        : 'Не удалось отправить заявку через почтовую службу. Пожалуйста, позвоните нам по номеру +7 (495) 725-6006.'
    }
  } catch (err) {
    console.error('Submit error:', err)
    submitError.value = 'Ошибка соединения с сервером. Пожалуйста, проверьте интернет или позвоните нам по номеру +7 (495) 725-6006.'
  } finally {
    isSubmitting.value = false
  }
}

function closeModal() {
  emit('update:modelValue', false)
  // Сброс через задержку анимации
  setTimeout(() => {
    isSubmitted.value = false
    submitError.value = ''
    form.name = ''
    form.phone = ''
    form.captcha = ''
    form.consent = false
    form.honeypot = ''
    errors.name = ''
    errors.phone = ''
    errors.captcha = ''
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
    generateCaptcha()
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

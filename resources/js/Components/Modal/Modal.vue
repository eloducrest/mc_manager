<script setup lang="ts">
import {computed, onMounted, onUnmounted, watch} from 'vue';

const props = withDefaults(
  defineProps<{
    show: boolean;
    minHeight?: 'min-content' | 'md' | 'lg' | 'xl';
    maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl' | '4xl' | '5xl' | '6xl';
    closeable?: boolean;
  }>(),
  {
    show: false,
    minHeight: 'min-content',
    maxWidth: '4xl',
    closeable: true,
  }
);

const emit = defineEmits(['close']);

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = 'hidden';
      let container = document.body;
      let firstChild = container.childNodes[1];
      if (container && firstChild) {
        let newPre = document.createElement('div');
        newPre.setAttribute("contentEditable", "true");
        newPre.style.position = 'absolute';
        newPre.style.top = '0';
        newPre.style.left = '0';
        newPre.style.width = '100%';
        newPre.style.backgroundColor = 'rgba(0,0,0, 0.4)';
        newPre.innerHTML = "boom";
        firstChild.parentNode.insertBefore(newPre, firstChild.nextSibling);
      }
    } else {
      document.body.style.overflow = 'visible';
    }
  }
);

const close = () => {
  if (props.closeable) {
    emit('close');
  }
};

const closeOnEscape = (e: KeyboardEvent) => {
  if (e.key === 'Escape' && props.show) {
    close();
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
  document.body.style.overflow = 'visible';
});

const minHeightClass = computed(() => {
  return {
    'min-content': 'sm:min-h-min',
    md: 'sm:min-h-[500px]',
    lg: 'sm:min-h-[600px]',
    xl: 'sm:min-h-[100%]',
  }[props.minHeight];
});
const maxWidthClass = computed(() => {
  return {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
    '4xl': 'sm:max-w-4xl',
    '5xl': 'sm:max-w-5xl',
    '6xl': 'sm:max-w-6xl',
  }[props.maxWidth];
});
</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-99999 bg-modal-overlay" scroll-region>
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0">
          <div v-show="show"
               class="fixed inset-0 transform transition-all"
               @click="close">
            <div class="absolute inset-0 opacity-75"/>
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div v-show="show"
               class="flex flex-col mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
               :class="`${maxWidthClass} ${minHeightClass}`">
            <slot v-if="show"/>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup lang="ts">
import {computed, onMounted, onUnmounted, watch} from 'vue';

const props = withDefaults(
  defineProps<{
    show?: boolean;
    header?: object | string;
    footer?: object | string;
    maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl' | '4xl';
    closeable?: boolean;
  }>(),
  {
    show: false,
    maxWidth: '4xl',
    closeable: true,
    header: undefined,
    footer: undefined
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

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
    '4xl': 'sm:max-w-4xl',
  }[props.maxWidth];
});
</script>
<template>
</template>

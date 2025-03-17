<script setup lang="ts">
export interface Props {
  label?: string,
  rows?: number,
  placeholder?: string,
  customClasses?: string,
  required?: true | false,
  modelValue?: string | number,
  errorMessage?: string | null,
}

const props = withDefaults(
  defineProps<Props>(),
  {
    label: '',
    rows: 6,
    placeholder: '',
    customClasses: '',
    required: false,
    modelValue: '',
    errorMessage: null
  }
);

const emit = defineEmits(['update:modelValue']);

const emitEvent = (event: Event) => {
  const target = event.target as HTMLInputElement;
  emit('update:modelValue', target.value);
}
</script>

<template>
  <div :class="props.customClasses">
    <label class="mb-2.5 block text-black dark:text-white">
      <span v-html="props.label"></span>
      <span v-if="props.required" class="text-meta-1">*</span>
    </label>
    <textarea :id="props.label"
              :rows="props.rows"
              :placeholder="props.placeholder"
              :required="props.required"
              :value="props.modelValue"
              @input="emitEvent"
              class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
              :class="{'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 ': errorMessage}"></textarea>
    <p v-if="errorMessage"
       class="mt-1 text-sm text-red-600 dark:text-red-500"
       v-text="errorMessage"></p>
  </div>
</template>

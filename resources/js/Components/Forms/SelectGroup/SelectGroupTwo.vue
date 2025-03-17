<script setup lang="ts">
export interface Option {
  id: number|null,
  value: string,
  label: string
}

export interface Props {
  label?: string,
  customClasses?: string,
  required?: true | false,
  modelValue?: string | number | null,
  hasError?: boolean,
  errorMessage?: string | null,
  options: Option[],
  bindOptions?: 'id' | 'value' | 'label' | 'name',
  bindLabel?: 'id' | 'value' | 'label' | 'name' | 'code'
}

const props = withDefaults(
  defineProps<Props>(),
  {
    label: '',
    customClasses: '',
    required: false,
    modelValue: '',
    hasError: false,
    errorMessage: null,
    options: [] as Option[],
    bindOptions: 'value',
    bindLabel: 'label'
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

    <div class="relative z-20 bg-transparent dark:bg-form-input">
      <select :id="props.label"
              :value="props.modelValue"
              :required="props.required"
              class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
              :class="{ 'text-black dark:text-white': props.modelValue }"
              @change="emitEvent">
        <option value="" disabled selected>Sélectionner</option>
        <option v-for="(option, idx) in props.options"
                :key="idx"
                :value="option[props.bindOptions]"
                v-text="option[props.bindLabel]"></option>
      </select>
    </div>
    <p v-if="errorMessage"
       class="mt-1 text-sm text-red-600 dark:text-red-500"
       v-text="errorMessage"></p>
  </div>
</template>

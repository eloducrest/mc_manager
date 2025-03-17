<script setup lang="ts">
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";

export interface Props {
  label: string,
  type?: 'text' | 'number' | 'password' | 'email' | 'tel' | 'url',
  placeholder?: string,
  customClasses?: string,
  required?: true | false,
  modelValue?: string | number | null,
  errorMessage?: string | null,
  autocomplete?: string,
}

const props = withDefaults(
  defineProps<Props>(),
  {
    label: '',
    type: 'text',
    placeholder: '',
    customClasses: '',
    required: false,
    modelValue: '',
    errorMessage: null,
    autocomplete: 'off',
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
    <InputLabel v-if="label.length" :label="props.label"
                :required="props.required"
                :for="props.label"/>
    <input :type="props.type"
           :id="props.label"
           :placeholder="props.placeholder"
           :required="props.required"
           :value="props.modelValue"
           @input="emitEvent"
           :autocomplete="props.autocomplete"
           class="w-full rounded-md shadow-sm text-black border-gray-300 bg-transparent py-2 px-3 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
           :class="{'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 ': errorMessage}"/>
    <InputError :message="errorMessage"/>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  close: () => void;
  submit?: () => void;
}>()
</script>

<template>
  <!-- Card content -->
  <div class="flex-1 flex flex-col relative bg-white rounded-lg shadow dark:bg-gray-700">
    <!-- Card header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b border-bodydark rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
        <slot name="title"></slot>
      </h3>
      <button @click="props.close()"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
    </div>
    <!-- Card body -->
    <div class="flex-1 p-4 md:p-5 space-y-4">
        <div class="mt-4">
          <slot name="body"></slot>
        </div>
    </div>
    <!-- Card footer -->
    <div class="flex items-center justify-end p-4 md:p-5 border-t border-bodydark rounded-b dark:border-gray-600">
      <button @click="props.submit()"
              type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Valider
      </button>
      <button @click="props.close()"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
        Annuler
      </button>
    </div>
  </div>
</template>

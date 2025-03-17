<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";

defineProps<{
  items?: Array<Object>,
  headers?: Array<Object>
  actions?: Array<Object>
}>()

const search_value = ref("")
</script>

<template>
  <div
    class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
  >
    <div class="p-6">
      <div class="dataTable-search flex justify-between">
        <input class="search" v-model="search_value" @input="$emit('search', search_value)"
               placeholder="Search..." type="text">
        <PrimaryButton class="flex items-center "
                       @click="$emit('add-row')">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/></svg>
          <span class="ml-2.5">Ajouter</span>
        </PrimaryButton>
      </div>
    </div>
    <div class="max-w-full overflow-x-auto">
      <table class="w-full table-auto">
        <thead>
        <tr class="bg-gray-2 text-left dark:bg-meta-4">
          <th v-for="(header, index) in headers" :key="index"
              class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
            {{ header.text }}
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, idx) in items" :key="idx">
          <td class="py-5 px-4 pl-9 xl:pl-11" v-for="(header, index) in headers" :key="index">
            <div v-if="actions && header.value === 'actions'"
                 class="flex items-center space-x-3.5">
              <button v-for="action in actions"
                      :class="action.btn_class"
                      @click="action.method(item, idx)"
                      v-html="action.icon">
              </button>
            </div>
            <h5 v-else
                class="font-medium text-black dark:text-white">{{ item[header.value] }}</h5>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

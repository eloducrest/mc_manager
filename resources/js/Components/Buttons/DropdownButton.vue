<script setup lang="ts">
import LightButton from "@/Components/LightButton.vue";
import Dropdown from "@/Components/Dropdown.vue";
import type {Component} from "vue";
import {Method} from "@inertiajs/core";

type Content = {
  name: string,
  route?: string,
  action?: () => void,
  icon: string
}

interface Props {
  buttonComponent?: Component,
  triggerLabel?: string,
  contents: Array<Content>,
}

withDefaults(
  defineProps<Props>(),
  {
    buttonComponent: LightButton,
    triggerLabel: 'Actions',
    contents: [
      {
        name: 'Télécharger',
        route: '',
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
      },
      {
        name: 'Importer',
        action: () => {
          return;
        },
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
      }
    ],
  }
);
</script>

<template>
  <dropdown>
    <template #trigger>
      <component :is="buttonComponent" class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <path fill="currentColor"
                d="m21.6 23l-3.075-3.05q-.45.275-.962.413T16.5 20.5q-1.65 0-2.825-1.175T12.5 16.5t1.175-2.825T16.5 12.5t2.825 1.175T20.5 16.5q0 .575-.15 1.088t-.425.962L23 21.6zM5.5 20.5q-1.65 0-2.825-1.175T1.5 16.5t1.175-2.825T5.5 12.5t2.825 1.175T9.5 16.5t-1.175 2.825T5.5 20.5m0-2q.825 0 1.412-.587T7.5 16.5t-.587-1.412T5.5 14.5t-1.412.588T3.5 16.5t.588 1.413T5.5 18.5m11 0q.825 0 1.413-.587T18.5 16.5t-.587-1.412T16.5 14.5t-1.412.588T14.5 16.5t.588 1.413t1.412.587m-11-9q-1.65 0-2.825-1.175T1.5 5.5t1.175-2.825T5.5 1.5t2.825 1.175T9.5 5.5T8.325 8.325T5.5 9.5m11 0q-1.65 0-2.825-1.175T12.5 5.5t1.175-2.825T16.5 1.5t2.825 1.175T20.5 5.5t-1.175 2.825T16.5 9.5m-11-2q.825 0 1.413-.587T7.5 5.5t-.587-1.412T5.5 3.5t-1.412.588T3.5 5.5t.588 1.413T5.5 7.5m11 0q.825 0 1.413-.587T18.5 5.5t-.587-1.412T16.5 3.5t-1.412.588T14.5 5.5t.588 1.413T16.5 7.5m0-2"/>
        </svg>
        <span class="ml-2.5" v-text="triggerLabel"></span>
      </component>
    </template>
    <template #content>
      <div v-for="(content, idx) in contents" :key="idx">
        <a v-if="content.route"
         :href="content.route"
         class="flex items-center w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
        <div v-if="content.icon"
             v-html="content.icon"></div>
        <span v-if="content.name" class="ml-2.5"
              v-text="content.name"></span>
      </a>
      <button v-else
           @click="content.action"
           class="flex items-center w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
        <div v-if="content.icon"
             v-html="content.icon"></div>
        <span v-if="content.name" class="ml-2.5"
              v-text="content.name"></span>
      </button>
      </div>
    </template>
  </dropdown>
</template>

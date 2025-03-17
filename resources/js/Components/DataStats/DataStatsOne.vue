<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
  total_costumes: number,
  total_actors: number,
  total_repairs: number,
  total_accessories: number,
}>()
const cardItems = ref([
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M8 2c-1 0-.815 2.417-2.2 3.462c-1.032.777-2.907-.048-3.672 1.259c-.233.398-.118.924.112 1.975l1.99 9.089C4.62 19.567 4.858 21.743 7 22h10c2.141-.257 2.38-2.433 2.77-4.215l1.99-9.089c.23-1.051.345-1.577.112-1.975c-.765-1.307-2.64-.482-3.671-1.26C16.815 4.418 17 2 16 2m-3.991 3.5H12"></path><path d="M7.724 2.119c.932-.524 2.217.822 2.88 1.325c.907.687 1.36 1.03 1.393 1.484a1 1 0 0 1 0 .144c-.033.453-.486.797-1.392 1.484c-.664.503-1.95 1.849-2.88 1.325c-.966-.542-.966-5.22 0-5.762"></path><path d="M16.276 2.119c-.932-.524-2.217.822-2.88 1.325c-.907.687-1.36 1.03-1.393 1.484a1 1 0 0 0 0 .144c.033.453.486.797 1.392 1.484c.664.503 1.95 1.849 2.88 1.325c.966-.542.966-5.22 0-5.762"></path></g></svg>`,
    title: 'Total Costumes',
    total: props.total_costumes,
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M29.183 20C31.264 15.054 36.35 10.667 39 8c1.104.667 5 2.604 5 7c0 4-1.455 7.111-3 8l-5.987 4.191a23 23 0 0 0-6.533 7.01L25 40H4v-4c2.429-1.333 9.82-5.867 13-8c7 4 10.5-4 12.183-8M43 21v19"></path></svg>`,
    title: 'Total Accessoires',
    total: props.total_accessories,
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#64758B" height="22" width="22" version="1.1" id="Capa_1" viewBox="0 0 297 297" xml:space="preserve">
<g>
\t<path d="M249.001,0.455c-4.369,0-8.859,0.758-13.35,2.252c-0.209,0.068-0.426,0.149-0.629,0.233   c-0.387,0.155-39.152,15.603-89.872,15.603c-29.764,0-57.743-5.248-83.161-15.6C57.194,0.99,52.337,0,47.553,0   C28.422,0,13.996,15.845,13.996,36.856v120.418C13.996,233.014,75.591,297,148.499,297c72.909,0,134.505-63.986,134.505-139.726   V36.856C283.004,15.765,268.703,0.455,249.001,0.455z M262.152,157.274c0,64.437-52.046,118.874-113.653,118.874   c-61.605,0-113.651-54.438-113.651-118.874V36.856c0-9.573,5.105-16.005,12.705-16.005c2.075,0,4.286,0.472,6.572,1.403   c27.927,11.373,58.553,17.14,91.025,17.14c52.892,0,92.842-15.204,97.355-16.992c2.266-0.726,4.449-1.096,6.496-1.096   c8.111,0,13.151,5.959,13.151,15.55V157.274z"></path>
\t<path d="M204.886,199.869c-3.442-3.063-8.714-2.754-11.774,0.689c-9.429,10.6-26.522,17.186-44.611,17.186   c-18.089,0-35.183-6.586-44.611-17.186c-3.06-3.442-8.332-3.75-11.774-0.689c-3.442,3.061-3.751,8.333-0.689,11.775   c12.687,14.265,34.022,22.781,57.075,22.781c23.053,0,44.39-8.517,57.075-22.781C208.637,208.202,208.328,202.93,204.886,199.869z"></path>
\t<path d="M239.494,121.283c-12.725-6.362-23.531-8.536-32.362-8.536c-18.463,0-28.256,9.506-28.848,10.099   c-3.313,3.202-3.374,8.336-0.168,11.67c3.205,3.333,8.505,3.434,11.816,0.236c0.559-0.521,14.049-12.573,42.101,1.451   c4.122,2.059,9.131,0.391,11.19-3.729C245.283,128.354,243.613,123.344,239.494,121.283z"></path>
\t<path d="M108.319,133.752c3.312,3.197,8.611,3.097,11.816-0.236c3.206-3.334,3.145-8.468-0.168-11.67   c-0.592-0.593-10.385-10.099-28.848-10.099c-8.831,0-19.637,2.174-32.362,8.536c-4.119,2.061-5.789,7.07-3.729,11.19   c2.06,4.12,7.068,5.788,11.19,3.729C94.27,121.179,107.761,133.23,108.319,133.752z"></path>
</g>
</svg>`,
    title: 'Total Acteurs',
    total: props.total_actors,
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="#64758B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>`,
    title: 'Total Réparations',
    total: props.total_repairs,
  }
])
</script>

<template>
  <!-- Card Item Start -->
  <div v-for="(item, index) in cardItems"
       :key="index"
       class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
         v-html="item.icon"></div>

    <div class="mt-4 flex items-end justify-between">
      <div>
        <h4 class="text-title-md font-bold text-black dark:text-white">{{ item.total }}</h4>
        <span class="text-sm font-medium">{{ item.title }}</span>
      </div>

      <span v-if="item.growthRate" class="flex items-center gap-1 text-sm font-medium"
            :class="{ 'text-meta-3': item.growthRate > 0, 'text-meta-5': item.growthRate < 0 }">
        {{ item.growthRate }}%
        <svg v-if="item.growthRate > 0"
             class="fill-meta-3"
             width="10"
             height="11"
             viewBox="0 0 10 11"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">
          <path d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                fill=""/>
        </svg>

        <svg v-if="item.growthRate < 0"
             class="fill-meta-5"
             width="10"
             height="11"
             viewBox="0 0 10 11"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">
          <path d="M5.64284 7.69237L9.09102 4.33987L10 5.22362L5 10.0849L-8.98488e-07 5.22362L0.908973 4.33987L4.35716 7.69237L4.35716 0.0848701L5.64284 0.0848704L5.64284 7.69237Z"
                fill=""/>
        </svg>
      </span>
    </div>
  </div>
  <!-- Card Item End -->
</template>

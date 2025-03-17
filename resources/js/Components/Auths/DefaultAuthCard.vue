<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

const props = defineProps(['subtitle', 'title', 'customClasses'])
</script>

<template>
  <!-- ====== Forms Section Start -->
  <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="flex flex-wrap items-center">
      <div class="hidden w-full xl:block xl:w-1/2">
        <div class="py-17.5 px-26 text-center">
          <h1 class="font-bold text-blue-950 text-4xl">Manager <span class="block text-3xl">nuits comtadines</span></h1>

          <p class="font-medium 2xl:px-20">
            Gestion des costumes et des acteurs du spectacle des nuits comtadines !
          </p>

          <span class="mt-15 inline-block">
            <img src="@/../assets/images/logo/logo_montjoie_comtadine.jpeg" alt="Logo" />
          </span>
        </div>
      </div>
      <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
          <span class="mb-1.5 block font-medium">{{ props.subtitle }}</span>
          <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
            {{ props.title }}
          </h2>

          <slot></slot>
        </div>
      </div>
    </div>
  </div>
  <!-- ====== Forms Section End -->
</template>

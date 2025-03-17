<script setup lang="ts">
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CostumesDatatable from "@/Components/Costumes/CostumesDatatable.vue";

const props = usePage().props
</script>

<template>
  <Head :title="`Emplacement : ${props.location.code}`"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="`Emplacement ${props.location.code}`"
                       :pageLabel="props.location.code"
                       :links="[{route: route('locations.index'), label: 'Emplacements'}]"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mx-auto flex flex-col items-center rounded-xl px-4 py-4 text-center md:flex-row md:items-start md:text-left">
          <div class="">
            <p class="text-2xl font-medium text-gray-700"
               v-text="`${props.location.code} : ${props.location.name}`"></p>
            <p class="mb-4 text-sm font-medium text-gray-500"
               v-text="props.location.description ?? 'Aucune description'"></p>
          </div>
        </div>
      </div>

      <div id="test" class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h2 class="font-medium text-black dark:text-white mb-5"
            v-text="`Costumes à cet emplacement : ${props.location.costumes.length}`"></h2>
        <costumes-datatable :costumes="props.location.costumes"></costumes-datatable>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

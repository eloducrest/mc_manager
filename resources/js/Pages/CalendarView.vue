<script setup lang="ts">
import { ref } from 'vue'
import BreadcrumbDefault from '@/Components/Breadcrumbs/BreadcrumbDefault.vue'
import CalendarCard from '@/Components/CalendarCard.vue'
import DefaultLayout from '@/Layouts/AuthenticatedLayout.vue'

const pageTitle = ref('Calender')
</script>

<template>
  <DefaultLayout>
    <div class="mx-auto max-w-7xl">
      <!-- Breadcrumb Start -->
      <BreadcrumbDefault :pageTitle="pageTitle" />
      <!-- Breadcrumb End -->
      <CalendarCard />
    </div>
  </DefaultLayout>
</template>

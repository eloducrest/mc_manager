<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import BreadcrumbDefault from '@/Components/Breadcrumbs/BreadcrumbDefault.vue'
import SettingsCard from '@/Components/SettingsCard.vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
  <Head title="Paramètres profil"/>

  <AuthenticatedLayout>
    <div class="mx-auto">
      <!-- Breadcrumb Start -->
      <BreadcrumbDefault pageTitle="Paramètres du compte" />
      <!-- Breadcrumb End -->
      <SettingsCard />
    </div>
  </AuthenticatedLayout>
</template>

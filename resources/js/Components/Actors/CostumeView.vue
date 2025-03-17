<script setup lang="ts">
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import Modal from "@/Components/Modal.vue";
import CostumeCard from "@/Pages/Costumes/CostumeCard.vue";
import {ref} from "vue";
import CostumeHistory from "@/Pages/Costumes/CostumeHistory.vue";

const props = usePage().props

const is_open_modal_costume = ref<boolean>(false);
const historyRefEl = ref<HTMLElement | null>(null)

function scrollTo(view: HTMLElement) {
  view.scrollIntoView({ behavior: 'smooth' })
}

const closeModal = (): void => {
  is_open_modal_costume.value = false;
}
</script>

<template>
  <Head :title="`Costume : ${props.costume.name}`"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="'Fiche costume : ' + props.costume.name"
                       :pageLabel="props.costume.name"
                       :links="[{route: route('costumes.index'), label: 'Costumes'}]"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div
          class="mx-auto flex flex-col items-center rounded-xl px-4 py-4 text-center md:flex-row md:items-start md:text-left">
          <div class="mb-4 md:mr-6 md:mb-0">
            <img class="rounded-lg object-cover md:w-56"
                 :src="props.costume.img_url" alt=""/>
          </div>
          <div class="">
            <p class="text-2xl font-medium text-gray-700"
               v-text="props.costume.number + ' : ' + props.costume.name"></p>
            <p class="mb-4 text-sm font-medium text-gray-500"
               v-text="props.costume.description ?? 'Aucune description'"></p>
            <div class="flex space-x-2">
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">État</p>
                <p class="text-xl font-medium text-gray-600" v-text="props.costume.condition"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Genre</p>
                <p class="text-xl font-medium text-gray-600" v-text="props.costume.gender"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Taille</p>
                <p class="text-xl font-medium text-gray-600 uppercase" v-text="props.costume.size?.name ?? 'N.C'"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Période</p>
                <p class="text-xl font-medium text-gray-600" v-text="props.costume.period?.name ?? 'N.C'"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Catégorie</p>
                <p class="text-xl font-medium text-gray-600" v-text="props.costume.category?.name ?? 'N.C'"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Caution</p>
                <p class="text-xl font-medium text-gray-600"
                   v-text="props.costume.deposit ? props.costume.deposit + ' €' : 'N.C'"></p>
              </div>
            </div>
            <div class="mb-3"></div>
            <div class="flex space-x-2">
              <button class="w-full rounded-lg border-2 border-transparent bg-blue-600 px-4 py-2 font-medium text-white"
                      @click="is_open_modal_costume = true">Modifier le costume
              </button>
              <button class="w-full rounded-lg border-2 bg-white px-4 py-2 font-medium text-gray-500"
                      @click="scrollTo(historyRefEl)">
                Voir l'historique
              </button>
            </div>
          </div>
        </div>
      </div>

      <div id="test" class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
           ref="historyRefEl">
        <h2>HISTORIQUE</h2>
        <costume-history :costume="props.costume"
                         :settings="usePage().props.costumes_settings"></costume-history>
      </div>
    </div>

    <Modal :show="is_open_modal_costume"
           @close="closeModal">
      <costume-card :costume="props.costume"
                    :settings="usePage().props.costumes_settings"
                    :is-update="true"
                    @close-modal="closeModal"></costume-card>
    </Modal>

  </AuthenticatedLayout>
</template>

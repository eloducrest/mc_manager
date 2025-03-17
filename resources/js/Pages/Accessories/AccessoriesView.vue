<script setup lang="ts">
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import Modal from "@/Components/Modal/Modal.vue";
import CostumeCard from "@/Components/Costumes/CostumeCard.vue";
import {ref} from "vue";

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
        <div class="px-4 flex items-center gap-3 text-xl text-[#ff0000] mb-6" v-if="props.costume.is_to_be_repaired">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.252 14.407a6.823 6.823 0 0 1-6.532 1.776a2.016 2.016 0 0 0-1.95.487l-4.28 4.294a.974.974 0 0 1-1.385 0l-2.067-2.069a.976.976 0 0 1 0-1.385l4.28-4.284a1.952 1.952 0 0 0 .488-1.951a6.835 6.835 0 0 1 1.912-6.65a6.823 6.823 0 0 1 6.736-1.566l-2.925 2.927c-.75.752-1.112 2.342-.341 3.103l1.715 1.727c.76.761 2.35.41 3.11-.351l2.925-2.927a6.836 6.836 0 0 1-1.686 6.869"/></svg>
          Costume en réparation
        </div>
        <div class="mx-auto flex flex-col items-center rounded-xl px-4 py-4 text-center md:flex-row md:items-start md:text-left">
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
<!--        <costume-history :costume="props.costume"
                         :settings="usePage().props.costumes_settings"></costume-history>-->
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

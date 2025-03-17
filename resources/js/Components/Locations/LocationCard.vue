<script setup lang="ts">
import {ref} from "vue";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useLocationsStore} from "@/stores/locations";
import {LocationInterface} from "@/interfaces/LocationInterface";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import CostumesDatatable from "@/Components/Costumes/CostumesDatatable.vue";

const location = useLocationsStore().selectedLocation;

const form = ref<LocationInterface>({
  id: location?.id ?? '',
  name: location?.name ?? '',
  label: location?.label ?? '',
  description: location?.description ?? '',
  code: location?.code ?? '',
  costumes: location?.costumes ?? [],
  created_at: location?.created_at ?? '',
  updated_at:  location?.updated_at ?? '',
  deleted_at:  location?.deleted_at ?? '',
})

const submitForm = async () =>  {
  let formData = new FormData();

  for (const [key, value] of Object.entries(form.value)) {
    if (Array.isArray(value)) {
      let index = 0;

      value.forEach(item => {
        formData.append(`${key}[${index}]`, item);
        index++;
      })
    } else {
      formData.append(key, value)
    }
  }

  await useCostumestore().postCostume('endPoint', 'post', formData)
    .then(() => {
      useHandleModalsStore().toggleModalQuickViewLocation()
    })
    .catch((e) => console.error(e));
}
</script>

<template>
  <!-- ====== Costume Section Start -->
  <cards-modal :close="useHandleModalsStore().toggleModalQuickViewLocation"
               :submit="submitForm">
    <template v-slot:title>
      {{ `Détails de l'emplacement ${location.name} / ${location.code}` }}
    </template>
    <template v-slot:body>
      <div class="p-6.5">
        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <div class="w-full xl:w-1/2">
            <div class="mb-4.5">
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Nom <span class="text-meta-1">*</span>
              </label>
              <input type="text" v-model="form.name"
                     placeholder="Nom de famille*" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
            </div>
          </div>

          <div class="w-full xl:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
              Code emplacement <span class="text-red-600">*</span>
            </label>
            <input type="text" v-model="form.code"
                   placeholder="Prénom*" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
          </div>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <div class="w-full">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
              Description <span class="text-red-600">*</span>
            </label>
            <textarea v-model="form.description"
                      placeholder="e-mail*"
                      rows="5"
                      class="resize-none w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
          </div>
        </div>
      </div>
    </template>
  </cards-modal>
  <div class="mt-4">
    <div class="p-6.5">
      <h4>Costumes à cet emplacement</h4>

      <costumes-datatable :costumes="location.costumes"></costumes-datatable>
    </div>
  </div>
  <!-- ====== Costume Section End -->
</template>

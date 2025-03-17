<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import ImageUploader from "@/Components/Forms/ImageUploader.vue";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import CheckboxTwo from "@/Components/Forms/Checkboxes/CheckboxTwo.vue";
import TextareaGroup from "@/Components/Forms/TextareaGroup.vue";
import SelectGroupTwo from "@/Components/Forms/SelectGroup/SelectGroupTwo.vue";

interface Props {
  redirect?: {
    route_name: 'costumes.index' | 'costumes.view',
    id?: number|null,
  },
}

const props = withDefaults(defineProps<Props>(), {
  redirect: {
    route_name: 'costumes.index',
    id: null,
  },
})

const modalStore = useHandleModalsStore();
const costumeStore = useCostumestore();
const costume = costumeStore.selectedCostume;

const form = useForm<CostumeInterface & {redirect: object}>({
  id: costume?.id ?? null,
  period_id: costume?.period_id ?? null,
  costumes_category_id: costume?.costumes_category_id ?? null,
  size_id: costume?.size_id ?? null,
  location_id: costume?.location_id ?? null,
  img_url: costume?.img_url ?? '',
  number: costume?.number ?? '',
  name: costume?.name ?? '',
  description: costume?.description ?? '',
  condition: costume?.condition ?? '',
  gender: costume?.gender ?? '',
  deposit: costume?.deposit ?? 0,
  type: 'Costume',
  is_to_be_repaired: false,
  redirect: props.redirect,
})

const imageUploaderChanged = (data: File) => {
  form.img_url = data
}

const submitForm = () =>  {
  costumeStore.postCostume(form);
}
</script>

<template>
  <!-- ====== Costume Section Start -->
  <cards-modal :close="modalStore.toggleModalCostume"
               :submit="submitForm">
    <template v-slot:title>
      {{ useCostumestore().isUpdate ? `Modifier le costume : ${costume?.name}` : 'Créer un nouveau costume' }}
    </template>
    <template v-slot:body>
      <image-uploader :image="form.img_url"
                      @change="imageUploaderChanged"></image-uploader>
      <div class="p-6.5">
        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Nom"
                       type="text"
                       placeholder="Nom"
                       :required="true"
                       :error-message="form.errors.name"
                       v-model="form.name"/>

          <input-group custom-classes="w-full xl:w-1/2"
                       label="Numéro"
                       type="text"
                       placeholder="Numéro unique du costume"
                       :required="true"
                       :error-message="form.errors.number"
                       v-model="form.number"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <div class="w-full xl:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
              Etat <span class="text-meta-1">*</span>
            </label>
            <div class="relative z-20 bg-transparent dark:bg-form-input">
              <select v-model="form.condition" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                <option value="" disabled selected>Sélectionner une condition</option>
                <option v-for="condition in costumeStore.costumeSettings.conditions"
                        :value="condition"
                        class="text-body">
                  {{ condition }}
                </option>
              </select>
            </div>
          </div>
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Montant Caution"
                       type="number"
                       placeholder="Montant caution demandée"
                       :required="true"
                       :error-message="form.errors.deposit"
                       v-model="form.deposit"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <select-group-two custom-classes="w-full xl:w-1/2"
                            label="Période"
                            :required="true"
                            model-value="period_id"
                            bind-label="name"
                            bind-options="id"
                            :error-message="form.errors.period_id"
                            :options="costumeStore.costumeSettings.periods"
                            v-model="form.period_id"/>

          <select-group-two custom-classes="w-full xl:w-1/2"
                            label="Genre"
                            :required="true"
                            model-value="name"
                            bind-label="name"
                            bind-options="name"
                            :error-message="form.errors.gender"
                            :options="costumeStore.costumeSettings.genders"
                            v-model="form.gender"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <select-group-two custom-classes="w-full xl:w-1/2"
                            label="Taille"
                            :required="true"
                            model-value="size_id"
                            bind-label="name"
                            bind-options="id"
                            :error-message="form.errors.size_id"
                            :options="costumeStore.costumeSettings.sizes"
                            v-model="form.size_id"/>

          <select-group-two custom-classes="w-full xl:w-1/2"
                            label="Catégorie"
                            :required="true"
                            model-value="size_id"
                            bind-label="name"
                            bind-options="id"
                            :error-message="form.errors.costumes_category_id"
                            :options="costumeStore.costumeSettings.categories"
                            v-model="form.costumes_category_id"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <select-group-two custom-classes="w-full xl:w-1/2"
                            label="Emplacement"
                            :required="true"
                            model-value="location_id"
                            bind-label="code"
                            bind-options="id"
                            :error-message="form.errors.location_id"
                            :options="costumeStore.costumeSettings.locations"
                            v-model="form.location_id"/>
        </div>

        <div class="mb-4.5">
          <textarea-group custom-classes="w-full"
                          label="Description"
                          :rows="3"
                          placeholder="Description du costume"
                          :required="true"
                          :error-message="form.errors.description"
                          v-model="form.description"/>
        </div>

        <checkbox-two custom-classes="mb-4.5 w-full xl:w-1/2"
                      label="Envoyer en réparation ?"
                      v-model="form.is_to_be_repaired"
                      :error-message="form.errors.is_to_be_repaired"/>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Costume Section End -->
</template>

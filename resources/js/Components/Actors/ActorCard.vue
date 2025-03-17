<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import {useActorsStore} from "@/stores/actors";
import {useHandleModalsStore} from "@/stores/handleModals";
import {ActorInterface} from "@/interfaces/ActorInterface";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import CheckboxTwo from "@/Components/Forms/Checkboxes/CheckboxTwo.vue";

interface Props {
  redirect?: string,
}

const props = withDefaults(defineProps<Props>(), {
  redirect: 'actors.index',
})

const actor: ActorInterface = useActorsStore().selectedActor;

const form = useForm<ActorInterface & {redirect: string}>({
  id:           actor.id ?? null,
  lastname:     actor.lastname ?? '',
  firstname:     actor.firstname ?? '',
  email:        actor.email ?? '',
  tel:          actor.tel ?? '',
  address:      actor.address ?? '',
  zip_code:     actor.zip_code ?? '',
  city:         actor.city ?? '',
  is_volunteer: actor.is_volunteer ?? true,
  size:         actor.size ?? '',
  shoe_size:    actor.shoe_size ?? '',
  costumes:     actor.costumes ?? [],
  redirect:     props.redirect,
})

const submitForm = () =>  {
  useActorsStore().postActor(form);
}
</script>

<template>
  <!-- ====== Costume Section Start -->
  <cards-modal :close="useHandleModalsStore().toggleModalActor"
               :submit="submitForm">
    <template v-slot:title>
      {{ useActorsStore().isUpdate ? 'Modifier l\'acteur : ' + actor.firstname + ' ' + actor.lastname : 'Ajouter un acteur' }}
    </template>
    <template v-slot:body>
      <div class="p-6.5">
        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Nom"
                       type="text"
                       placeholder="Nom de famille"
                       :required="true"
                       :error-message="form.errors.lastname"
                       v-model="form.lastname"/>
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Prénom"
                       type="text"
                       placeholder="Prénom"
                       :required="true"
                       :error-message="form.errors.firstname"
                       v-model="form.firstname"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="E-mail"
                       type="email"
                       placeholder="E-mail"
                       :required="true"
                       :error-message="form.errors.email"
                       v-model="form.email"/>
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Téléphone"
                       type="tel"
                       placeholder="Téléphone"
                       :required="true"
                       :error-message="form.errors.tel"
                       v-model="form.tel"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Adresse"
                       type="text"
                       placeholder="Adresse"
                       :required="true"
                       :error-message="form.errors.address"
                       v-model="form.address"/>
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Code postal"
                       type="text"
                       placeholder="Code postal"
                       :required="true"
                       :error-message="form.errors.zip_code"
                       v-model="form.zip_code"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Ville"
                       type="text"
                       placeholder="Ville"
                       :required="true"
                       :error-message="form.errors.city"
                       v-model="form.city"/>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Taille"
                       type="text"
                       placeholder="Taille"
                       :required="true"
                       :error-message="form.errors.size"
                       v-model="form.size"/>
          <input-group custom-classes="w-full xl:w-1/2"
                       label="Taille chaussure"
                       type="text"
                       placeholder="Taille chaussure"
                       :required="true"
                       :error-message="form.errors.shoe_size"
                       v-model="form.shoe_size"/>
        </div>

        <checkbox-two custom-classes="mb-4.5 w-full xl:w-1/2"
                      label="Est bénévole ?"
                      v-model="form.is_volunteer"
                      :error-message="form.errors.is_volunteer"/>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Costume Section End -->
</template>

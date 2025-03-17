<script setup lang="ts">
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {useUsersStore} from "@/stores/users";
import {useHandleModalsStore} from "@/stores/handleModals";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import ImageUploader from "@/Components/Forms/ImageUploader.vue";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import {UserInterface} from "@/interfaces/UserInterface";

const user = useUsersStore().selectedUser;

const form = useForm<UserInterface>({
  id:         user.id,
  firstname:   user.firstname,
  lastname:   user.lastname,
  role:       user.role,
  function:   user.function,
  email:      user.email,
  tel:        user.tel,
  img_profile: user.img_profile,
  created_at: user.created_at,
  updated_at: user.updated_at,
  deleted_at: user.deleted_at
});

const isOptionSelected = ref(false);

const imageUploaderChanged = (data: File) => {
  form.img_profile = data
}

const submitForm = () => {
  useUsersStore().postUser(form)
}
</script>
<template>
  <!-- ====== Profile Section Start -->
  <cards-modal :close="useHandleModalsStore().toggleModalUser"
               :submit="submitForm">
    <template v-slot:title>
      {{ useUsersStore().isUpdate ? 'Modifier l\'utilisateur : ' + user.firstname + ' ' + user.lastname : 'Ajouter un utilisateur' }}
    </template>
    <template v-slot:body>
      <image-uploader :image="user?.img_profile ?? 'https://ui-avatars.com/api/?background=random&rounded=true'"
                      @change="imageUploaderChanged"></image-uploader>
      <div class="p-6.5">
        <div class="mt-4">
        <form @submit.prevent="submitForm">
          <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
              <input-group custom-classes="w-full xl:w-1/2"
                       label="Prénom"
                       type="text"
                       placeholder="Prénom"
                       :required="true"
                       :error-message="form.errors.firstname"
                       v-model="form.firstname"/>

              <input-group custom-classes="w-full xl:w-1/2"
                       label="NOM"
                       type="text"
                       placeholder="NOM"
                       :required="true"
                       :error-message="form.errors.lastname"
                       v-model="form.lastname"/>
            </div>

            <div class="mb-4.5">
              <input-group custom-classes="w-full"
                       label="E-mail"
                       type="email"
                       placeholder="E-mail"
                       :required="true"
                       :error-message="form.errors.email"
                       v-model="form.email"/>
            </div>

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
              <input-group custom-classes="w-full xl:w-1/2"
                       label="Fonction"
                       type="text"
                       placeholder="Fonction"
                       :required="true"
                       :error-message="form.errors.function"
                       v-model="form.function"/>

              <div class="w-full xl:w-1/2">
                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                  Role <span class="text-meta-1">*</span>
                </label>
                <div class="relative z-20 bg-transparent dark:bg-form-input">
                  <select v-model="form.role" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" :class="isOptionSelected ?? 'text-black dark:text-white'" @change="isOptionSelected = true">
                    <option disabled value="" class="text-body">
                      Sélectionner un role
                    </option>
                    <option value="admin" class="text-body">Admin</option>
                    <option value="user" class="text-body">Utilisateur</option>
                  </select>
                </div>
              </div>
            </div>

            <input-group custom-classes="mb-4.5 w-full xl:w-1/2"
                       label="Téléphone"
                       type="text"
                       placeholder="Téléphone"
                       :required="true"
                       :error-message="form.errors.tel"
                       v-model="form.tel"/>
          </div>
        </form>
      </div>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Profile Section End -->
</template>

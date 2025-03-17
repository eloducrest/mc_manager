<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import Modal from '@/Components/Modal/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
import {nextTick, ref} from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => {
      form.reset();
    },
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <section class="p-7">

    <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

    <Modal :show="confirmingUserDeletion"
           :min-height="'min-content'"
           @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          Êtes-vous sûr de vouloir supprimer votre compte ?
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
          Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement
          votre compte.
        </p>

        <div class="mt-6">
          <InputLabel for="password" value="Mot de passe" class="sr-only"/>

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            @keyup.enter="deleteUser"
          />

          <InputError :message="form.errors.password" class="mt-2"/>
        </div>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal">Annuler</SecondaryButton>

          <DangerButton class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser">
            Supprimer mon compte
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>

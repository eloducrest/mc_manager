<script setup lang="ts">
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import {useAlerts} from "@/composables/alerts";
import InputGroup from "@/Components/Forms/InputGroup.vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            useAlerts().success('Mot de passe mis à jour avec succès !')
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>

<template>
    <section class="p-7">
      <form @submit.prevent="updatePassword">
        <div class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-y-5.5 md:gap-x-11 mb-5.5">
            <div class="col-span-1">
              <InputGroup label="Mot de passe actuel"
                    type="password"
                          autocomplete="current-password"
                    v-model="form.current_password"
                    :required="true"/>
            </div>

            <div class="col-span-1 col-start-1">
              <InputGroup label="Nouveau mot de passe"
                    type="password"
                          autocomplete="new-password"
                    v-model="form.password"
                    :required="true"/>
            </div>

            <div class="col-span-1">
              <InputGroup label="Confirmer nouveau mot de passe"
                    type="password"
                          autocomplete="new-password"
                    v-model="form.password_confirmation"
                    :required="true"/>
            </div>
        </div>

        <div class="flex justify-end gap-4.5">
          <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  type="submit">
            Sauvegarder
          </button>
        </div>
      </form>
    </section>
</template>

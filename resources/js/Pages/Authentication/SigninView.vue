<script setup lang="ts">
import DefaultAuthCard from '@/Components/Auths/DefaultAuthCard.vue'
import DefaultLayout from '@/Layouts/GuestLayout.vue'

import {Head, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";

import { useAuthStore } from '@/stores/auth';

const form = useForm({
  email: 'eloi@letmotiv.io',
  password: 'password',
  remember: false,
});

async function submit() {
  const authStore = useAuthStore();
  authStore.login(form);
}
</script>

<template>
  <DefaultLayout>
    <Head title="Connexion" />

    <DefaultAuthCard title="Se connecter">
      <form @submit.prevent="submit">
        <div>
          <InputLabel for="email" value="Email" />

          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            :class="form.errors.email ? 'border-red-600 dark:border-red-400' : ''"
            v-model="form.email"
            required
            autofocus
            autocomplete="username"
          />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
          <InputLabel for="password" value="Password" />

          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
          />

          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mb-5 mt-6">
          <PrimaryButton class="w-full"
                         :class="{ 'opacity-25': form.processing }"
                         :disabled="form.processing">
            Connexion
          </PrimaryButton>
        </div>
      </form>
    </DefaultAuthCard>
  </DefaultLayout>
</template>

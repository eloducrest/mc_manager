<script setup lang="ts">
import {useForm, usePage} from '@inertiajs/vue3';
import {useAuthStore} from "@/stores/auth";
import InputGroup from "@/Components/Forms/InputGroup.vue";

const user = usePage().props.auth.user;
const store = useAuthStore();

const form = useForm({
  firstname: user.firstname,
  lastname: user.lastname,
  email: user.email,
  tel: user.tel,
  function: user.function,
});

const submit = () => {
  store.update(form);
}
</script>

<template>
  <form @submit.prevent="submit">
    <!-- Full Name Section -->
    <div class="mb-6 flex flex-col gap-5.5 sm:flex-row">
      <!-- First Name -->
      <div class="w-full sm:w-1/2">
        <InputGroup label="Prénom"
                    type="text"
                    v-model="form.firstname"
                    :required="true"/>
      </div>
      <!-- Last Name -->
      <div class="w-full sm:w-1/2">
        <InputGroup label="Nom"
                    type="text"
                    v-model="form.lastname"
                    :required="true"/>
      </div>
    </div>

    <!-- Section -->
    <div class="mb-6 flex flex-col gap-5.5 sm:flex-row">
      <!-- Phone Number Section -->
      <div class="w-full sm:w-1/2">
        <InputGroup label="Téléphone"
                    type="tel"
                    v-model="form.tel"
                    :required="true"/>
      </div>

      <!-- Function Section -->

      <div class="w-full sm:w-1/2">
        <InputGroup label="Fonction"
                    type="text"
                    v-model="form.function"
                    :required="true"/>
      </div>
    </div>

    <!-- Email Address Section -->
    <div class="mb-6">
      <InputGroup label="Email"
                    type="email"
                    v-model="form.email"
                    :required="true"/>
    </div>

    <div class="flex justify-end gap-4.5">
      <button
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="submit">
        Sauvegarder
      </button>
    </div>
  </form>
</template>

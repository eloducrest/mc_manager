<script setup lang="ts">
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import {usePage} from "@inertiajs/vue3";
import UpdateProfilePictureForm from "@/Pages/Profile/Partials/UpdateProfilePictureForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
</script>

<template>
  <div class="grid grid-cols-5 gap-8">
    <!-- Personal Information Section -->
    <div class="col-span-5 xl:col-span-3">
      <div class="rounded-lg h-full border border-stroke bg-white shadow">
        <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">Information personnelle</h3>
        </div>
        <div class="p-7">
          <UpdateProfileInformationForm/>
        </div>
      </div>
    </div>

    <!-- Your Photo Section -->
    <div class="col-span-5 xl:col-span-2">
      <div class="rounded-lg h-full border border-stroke bg-white shadow">
        <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">Votre photo</h3>
        </div>
        <div class="p-7">
          <update-profile-picture-form></update-profile-picture-form>
        </div>
      </div>
    </div>

    <!-- Your Password section -->
    <div class="col-span-5">
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">Modifier votre mot de passe</h3>
        </div>
        <UpdatePasswordForm/>
      </div>
    </div>

    <!-- Your Password section -->
    <div class="col-span-5">
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
          <h3 class="font-medium text-black dark:text-white">Supprimer votre compte</h3>
        </div>
        <DeleteUserForm/>
      </div>
    </div>
  </div>
</template>

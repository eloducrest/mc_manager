<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
  name: 'DefaultLayout'
})
</script>

<template>
  <!-- ===== Main Content Start ===== -->
  <main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
      <slot></slot>
    </div>
  </main>
</template>

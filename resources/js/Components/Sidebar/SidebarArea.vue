<script setup lang="ts">
import {useSidebarStore} from '@/stores/sidebar'
import {onClickOutside} from '@vueuse/core'
import {ref} from 'vue'
import {Link} from '@inertiajs/vue3';

import SidebarItem from './SidebarItem.vue'

const target = ref(null)

const sidebarStore = useSidebarStore()

onClickOutside(target, () => {
  sidebarStore.isSidebarOpen = false
})

const menuGroups = ref([
  {
    name: 'MENU',
    menuItems: [
      {
        icon: `<svg
                  class="fill-current"
                  width="22px"
                  height="22px"
                  viewBox="0 0 18 18"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                    fill=""
                  />
                  <path
                    d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                    fill=""
                  />
                  <path
                    d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                    fill=""
                  />
                  <path
                    d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                    fill=""
                  />
                </svg>`,
        label: 'Accueil',
        name: 'dashboard',
        route: route('dashboard'),
      },
      {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#FFFFFF" height="22" width="22" version="1.1" id="Capa_1" viewBox="0 0 297 297" xml:space="preserve">
<g>
\t<path d="M249.001,0.455c-4.369,0-8.859,0.758-13.35,2.252c-0.209,0.068-0.426,0.149-0.629,0.233   c-0.387,0.155-39.152,15.603-89.872,15.603c-29.764,0-57.743-5.248-83.161-15.6C57.194,0.99,52.337,0,47.553,0   C28.422,0,13.996,15.845,13.996,36.856v120.418C13.996,233.014,75.591,297,148.499,297c72.909,0,134.505-63.986,134.505-139.726   V36.856C283.004,15.765,268.703,0.455,249.001,0.455z M262.152,157.274c0,64.437-52.046,118.874-113.653,118.874   c-61.605,0-113.651-54.438-113.651-118.874V36.856c0-9.573,5.105-16.005,12.705-16.005c2.075,0,4.286,0.472,6.572,1.403   c27.927,11.373,58.553,17.14,91.025,17.14c52.892,0,92.842-15.204,97.355-16.992c2.266-0.726,4.449-1.096,6.496-1.096   c8.111,0,13.151,5.959,13.151,15.55V157.274z"/>
\t<path d="M204.886,199.869c-3.442-3.063-8.714-2.754-11.774,0.689c-9.429,10.6-26.522,17.186-44.611,17.186   c-18.089,0-35.183-6.586-44.611-17.186c-3.06-3.442-8.332-3.75-11.774-0.689c-3.442,3.061-3.751,8.333-0.689,11.775   c12.687,14.265,34.022,22.781,57.075,22.781c23.053,0,44.39-8.517,57.075-22.781C208.637,208.202,208.328,202.93,204.886,199.869z"/>
\t<path d="M239.494,121.283c-12.725-6.362-23.531-8.536-32.362-8.536c-18.463,0-28.256,9.506-28.848,10.099   c-3.313,3.202-3.374,8.336-0.168,11.67c3.205,3.333,8.505,3.434,11.816,0.236c0.559-0.521,14.049-12.573,42.101,1.451   c4.122,2.059,9.131,0.391,11.19-3.729C245.283,128.354,243.613,123.344,239.494,121.283z"/>
\t<path d="M108.319,133.752c3.312,3.197,8.611,3.097,11.816-0.236c3.206-3.334,3.145-8.468-0.168-11.67   c-0.592-0.593-10.385-10.099-28.848-10.099c-8.831,0-19.637,2.174-32.362,8.536c-4.119,2.061-5.789,7.07-3.729,11.19   c2.06,4.12,7.068,5.788,11.19,3.729C94.27,121.179,107.761,133.23,108.319,133.752z"/>
</g>
</svg>`,
        label: 'Acteurs',
        name: 'actors',
        route: route('actors.index')
      },
      {
        icon: `
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M8 2c-1 0-.815 2.417-2.2 3.462c-1.032.777-2.907-.048-3.672 1.259c-.233.398-.118.924.112 1.975l1.99 9.089C4.62 19.567 4.858 21.743 7 22h10c2.141-.257 2.38-2.433 2.77-4.215l1.99-9.089c.23-1.051.345-1.577.112-1.975c-.765-1.307-2.64-.482-3.671-1.26C16.815 4.418 17 2 16 2m-3.991 3.5H12"></path><path d="M7.724 2.119c.932-.524 2.217.822 2.88 1.325c.907.687 1.36 1.03 1.393 1.484a1 1 0 0 1 0 .144c-.033.453-.486.797-1.392 1.484c-.664.503-1.95 1.849-2.88 1.325c-.966-.542-.966-5.22 0-5.762"></path><path d="M16.276 2.119c-.932-.524-2.217.822-2.88 1.325c-.907.687-1.36 1.03-1.393 1.484a1 1 0 0 0 0 .144c.033.453.486.797 1.392 1.484c.664.503 1.95 1.849 2.88 1.325c.966-.542.966-5.22 0-5.762"></path></g></svg>`,
        label: 'Costumes',
        name: 'costumes',
        route: route('costumes.index')
      },
      {
        icon: `
        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M29.183 20C31.264 15.054 36.35 10.667 39 8c1.104.667 5 2.604 5 7c0 4-1.455 7.111-3 8l-5.987 4.191a23 23 0 0 0-6.533 7.01L25 40H4v-4c2.429-1.333 9.82-5.867 13-8c7 4 10.5-4 12.183-8M43 21v19"/></svg>`,
        label: 'Accessoires',
        name: 'accessories',
        route: route('accessories.index')
      },
      {
        icon: `
        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M9 5a7 7 0 0 0-7 7a7 7 0 0 0 7 7c1.04 0 2.06-.24 3-.68c.94.44 1.96.68 3 .68a7 7 0 0 0 7-7a7 7 0 0 0-7-7c-1.04 0-2.06.24-3 .68c-.94-.44-1.96-.68-3-.68m0 2c.34 0 .67.03 1 .1c-1.28 1.31-2 3.07-2 4.9s.72 3.59 2 4.89c-.33.07-.66.11-1 .11a5 5 0 0 1-5-5a5 5 0 0 1 5-5m6 0a5 5 0 0 1 5 5a5 5 0 0 1-5 5c-.34 0-.67-.03-1-.1c1.28-1.31 2-3.07 2-4.9s-.72-3.59-2-4.89c.33-.07.66-.11 1-.11m-3 1c1.26.95 2 2.43 2 4s-.74 3.05-2 4a5.01 5.01 0 0 1-2-4c0-1.57.74-3.05 2-4"/></svg>`,
        label: 'Ensembles',
        name: 'packages',
        route: route('packages.index')
      },
      {
        icon: `
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>`,
        label: 'Réparations',
        name: 'repairs',
        route: route('repairs.index')
      },
      {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 48c-79.5 0-144 61.39-144 137c0 87 96 224.87 131.25 272.49a15.77 15.77 0 0 0 25.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137"/><circle cx="256" cy="192" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>`,
        label: 'Emplacements',
        name: 'locations',
        route: route('locations.index')
      },
    ]
  },
  {
    name: 'REGLAGES',
    menuItems: [
      {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 256 256"><path fill="currentColor" d="M125.18 156.94a64 64 0 1 0-82.36 0a100.23 100.23 0 0 0-39.49 32a12 12 0 0 0 19.35 14.2a76 76 0 0 1 122.64 0a12 12 0 0 0 19.36-14.2a100.33 100.33 0 0 0-39.5-32M44 108a40 40 0 1 1 40 40a40 40 0 0 1-40-40m206.1 97.67a12 12 0 0 1-16.78-2.57A76.31 76.31 0 0 0 172 172a12 12 0 0 1 0-24a40 40 0 1 0-10.3-78.67a12 12 0 1 1-6.16-23.19a64 64 0 0 1 57.64 110.8a100.23 100.23 0 0 1 39.49 32a12 12 0 0 1-2.57 16.73"/></svg>`,
        label: 'Utilisateurs',
        name: 'users',
        route: route('users.index'),
      },
      {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M19.43 12.98c.04-.32.07-.64.07-.98c0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46a.5.5 0 0 0-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1a.566.566 0 0 0-.18-.03c-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98c0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46a.5.5 0 0 0 .61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03c.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64zm-1.98-1.71c.04.31.05.52.05.73c0 .21-.02.43-.05.73l-.14 1.13l.89.7l1.08.84l-.7 1.21l-1.27-.51l-1.04-.42l-.9.68c-.43.32-.84.56-1.25.73l-1.06.43l-.16 1.13l-.2 1.35h-1.4l-.19-1.35l-.16-1.13l-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7l-1.06.43l-1.27.51l-.7-1.21l1.08-.84l.89-.7l-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13l-.89-.7l-1.08-.84l.7-1.21l1.27.51l1.04.42l.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43l.16-1.13l.2-1.35h1.39l.19 1.35l.16 1.13l1.06.43c.43.18.83.41 1.23.71l.91.7l1.06-.43l1.27-.51l.7 1.21l-1.07.85l-.89.7zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4s4-1.79 4-4s-1.79-4-4-4m0 6c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2"/></svg>`,
        label: 'Paramètres',
        name: 'settings',
        route: '/app-settings',
      },
   ]
  }
])
</script>

<template>
  <aside class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
         :class="{
           'translate-x-0': sidebarStore.isSidebarOpen,
           '-translate-x-full': !sidebarStore.isSidebarOpen
          }"
         ref="target">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">

      <Link href="/" class="max-w-48 mx-auto">
        <img src="@/../assets/images/logo/Logo_blanc_les_nuits_comtadines_c1a3f3eef3.png" alt="Logo"/>
      </Link>

      <button class="block lg:hidden" @click="sidebarStore.isSidebarOpen = false">
        <svg class="fill-current"
             width="20"
             height="18"
             viewBox="0 0 20 18"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">
          <path d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                fill=""/>
        </svg>
      </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
      <!-- Sidebar Menu -->
      <nav class="mt-5 py-4 px-4 lg:mt-0 lg:px-6">
        <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
          <div>
            <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">{{ menuGroup.name }}</h3>

            <ul class="mb-6 flex flex-col gap-1.5">
              <SidebarItem v-for="(menuItem, index) in menuGroup.menuItems"
                           :item="menuItem"
                           :key="index"
                           :index="index"/>
            </ul>
          </div>
        </template>
      </nav>
      <!-- Sidebar Menu -->
    </div>
  </aside>
</template>

import './bootstrap';
import '../scss/app.scss';

import {createApp, h, DefineComponent} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {createPinia} from 'pinia';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';

// Algolia
import InstantSearch from 'vue-instantsearch/vue3/es';

// Vue3 easy data table
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

// Vue3 toastification
import Toast from "vue-toastification";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup({el, App, props, plugin}) {
    createApp({render: () => h(App, props)})
      .use(plugin)
      .use(createPinia())
      .use(Toast)
      .use(ZiggyVue)
      .component('EasyDataTable', Vue3EasyDataTable)
      .use(InstantSearch)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});

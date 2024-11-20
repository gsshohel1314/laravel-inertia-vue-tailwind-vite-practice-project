import './bootstrap';
import '../css/app.css';
import 'flowbite';

import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from "./Layouts/Layout.vue"
import AuthLayout from './Layouts/AuthLayout.vue'
import { ZiggyVue } from "../../vendor/tightenco/ziggy"

createInertiaApp({
  title: title => `My app ${title}`,
  resolve: name => {    
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]

    // Set default layout globally
    // if (name.startsWith('Frontend/')) {
    //   page.default.layout = AuthLayout
    // } else if(name.startsWith('Backend/')) {
    //   page.default.layout = Layout
    // } else {
    //   page.default.layout = page.default.layout
    // }
    
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el)
  },
  progress: {
    color: 'red',
    includeCSS: true,
    showSpinner: true,
  },
})

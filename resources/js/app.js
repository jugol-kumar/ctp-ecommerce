import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueFeather from 'vue-feather';
import Layout from "./Shared/Layout.vue";
import store from './Store'
import { createVbPlugin } from 'vue3-plugin-bootstrap5'
import { Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip } from 'bootstrap'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
// import('../sass/app.scss')
let vbPlugin = createVbPlugin({ Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip})

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import coreUi from '@coreui/vue'
import {vctooltip} from "@coreui/vue";
import sujest from "./components/Sujesation.vue";


// createInertiaApp({
//   resolve: name => {
//     let page = require(`./Pages/${name}`).default;
//
//     if (page.layout === undefined) {
//       page.layout = Layout;
//     }
//
//     return page;
//   },
//   setup({ el, App, props, plugin }) {
//     createApp({ render: () => h(App, props) })
//       .use(plugin)
//       .use(vbPlugin)
//       .use(store)
//       .component("Link", Link)
//       .component("Head", Head)
//       .component(VueFeather.name, VueFeather)
//       .mount(el);
//   },
//
//   title: title => `My App - ${title}`
// });




createInertiaApp({
    title: (title) => `My App - ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .use(vbPlugin)
            .use(coreUi)
            .directive('tooltip', vctooltip)
            .use(store)
            .component("Link", Link)
            .component("Head", Head)
            .component('info', sujest)
            .component(VueFeather.name, VueFeather)
            .component("vSelect", vSelect)
            .mount(el);
    },
    progress: {
        color: '#29d',
        showSpinner: true,
    },
    // ...
}).then(r => {});


//
// InertiaProgress.init({
//   color: "red",
//   showSpinner: true,
// });

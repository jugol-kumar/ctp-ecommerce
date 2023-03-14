<template>
    <div class="main-menu menu-fixed menu-accordion menu-shadow"
         :class="[
      { 'expanded': !isVerticalMenuCollapsed || (isVerticalMenuCollapsed && isMouseHovered) },
      themeSkin === 'light'|| themeSkin === 'bordered' ? 'menu-light' : 'menu-dark'
    ]"
         @mouseenter="updateMouseHovered(true)"
         @mouseleave="updateMouseHovered(false)"
    >
        <div class="navbar-header expanded">
            <slot
                name="header"
                :toggleVerticalMenuActive="toggleVerticalMenuActive"
                :toggleCollapsed="toggleCollapsed"
                :collapseTogglerIcon="collapseTogglerIcon"
            >
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto"><Link preserve-scroll class="navbar-brand"
                                                       href="#">
                            <span class="brand-logo">
                            </span>
                        <h2 class="brand-text">Hat Bazar</h2>
                    </Link></li>
                    <li class="nav-item nav-toggle">
                        <Link preserve-scroll class="nav-link modern-nav-toggle">
                            <vue-feather type="x" @click="toggleVerticalMenuActive" class="d-block d-xl-none" />
                            <vue-feather :type="collapseTogglerIconFeather" @click="toggleCollapsed" class="d-none d-xl-block collapse-toggle-icon" />
                        </Link>
                    </li>
                </ul>
            </slot>
        </div>
        <div class="shadow-bottom"></div>
        <perfect-scrollbar>
            <div class="main-menu-content scroll-area">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <Link preserve-scroll class="d-flex align-items-center" href="#">
                            <vue-feather type="home" />
                            <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                        </Link>
                    </li>

                    <li class=" nav-item has-sub" :class="{'open' : clickMenu === 1}" @click.prevent="toggleSubMenu(1)">
                        <a preserve-scroll class="d-flex align-items-center">
                            <vue-feather type="users" />
                            <span class="menu-title text-truncate"
                                  data-i18n="Authentication">User Management</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" href="#">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Role & Permissions</span>
                                </Link>
                            </li>
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" href="#">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Manage Stuff</span>
                                </Link>
                            </li>
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" href="#">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Manage Customer</span>
                                </Link>
                            </li>
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" href="#">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Manage Subscribers</span>
                                </Link>
                            </li>
                        </ul>
                    </li>


                    <li class=" nav-item has-sub" :class="{'open' : clickMenu === 2}" @click.prevent="toggleSubMenu(2)">
                        <a preserve-scroll class="d-flex align-items-center">
                            <vue-feather type="users" />
                            <span class="menu-title text-truncate"
                                  data-i18n="Authentication">Products</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" :href="`${this.$page.props.auth.ADMIN_URL}/products`">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Products</span>
                                </Link>
                            </li>
                            <li>
                                <Link preserve-scroll class="d-flex align-items-center" :href="`${this.$page.props.auth.ADMIN_URL}/category`">
                                    <vue-feather type="circle" />
                                    <span class="menu-item text-truncate" data-i18n="Login">Category</span>
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </perfect-scrollbar>
    </div>
</template>

<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import { ref, computed, onMounted } from 'vue'
import { useStore } from 'vuex'

const props = defineProps({
    isVerticalMenuActive: {
        type: Boolean,
        required: true,
    },
    toggleVerticalMenuActive: {
        type: Function,
        required: true,
    },
})
const isMouseHovered = ref(false)
const store = useStore()

const themeSkin = computed(() => store.state.skin)
const isVerticalMenuCollapsed = computed(() => store.state.isVerticalMenuCollapsed)

const collapseTogglerIconFeather = computed(() => (collapseTogglerIcon.value === 'unpinned' ? 'circle' : 'disc'))

onMounted(() => store.commit('UDATE_SKIN', themeSkin.value))

const collapseTogglerIcon = computed(() => {
    if (props.isVerticalMenuActive) {
        return isVerticalMenuCollapsed.value ? 'unpinned' : 'pinned'
    }
    return 'close'
})

const toggleCollapsed = () => {
    store.commit('UPDATE_MENU_COLLAPSED', !isVerticalMenuCollapsed.value)
}

const openClass = ref('')
const clickMenu = ref(0)
// const toggleSubMenu = (val) => {
//     document.getElementById(`menu-${val}`).classList.toggle("open");
// }

const toggleSubMenu = (val) => {
    openClass.value = openClass.value ? '' : 'open'
    clickMenu.value = clickMenu.value === val ? 0 : val
}

const updateMouseHovered = val => {
    isMouseHovered.value = val
}
</script>

<style src="vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css"/>

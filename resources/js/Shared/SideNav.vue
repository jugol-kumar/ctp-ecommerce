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
                    <li class="nav-item me-auto"><a class="navbar-brand"
                            href="#">
                            <span class="brand-logo">
                            </span>
                            <h2 class="brand-text">Vuexy</h2>
                        </a></li>
                    <li class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle">
                            <vue-feather type="x" @click="toggleVerticalMenuActive" class="d-block d-xl-none" />
                            <vue-feather :type="collapseTogglerIconFeather" @click="toggleCollapsed" class="d-none d-xl-block collapse-toggle-icon" />
                        </a>
                    </li>
                </ul>
            </slot>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a class="d-flex align-items-center" :href="$page.props.auth.ADMIN_URL+'/dashboard'">
                        <vue-feather type="home" />
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" :href="$page.props.auth.ADMIN_URL+'/products'">
                        <vue-feather type="mail" />
                        <span class="menu-title text-truncate" data-i18n="Email">Products</span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" :href="$page.props.auth.MAIN_URL">
                        <vue-feather type="message-square" />
                        <span class="menu-title text-truncate" data-i18n="Chat">Chat</span>
                    </a>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <vue-feather type="file-text" />
                        <span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="d-flex align-items-center" href="app-invoice-list.html">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="List">List</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="app-invoice-preview.html">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Preview">Preview</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="app-invoice-edit.html">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Edit">Edit</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="app-invoice-add.html">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Add">Add</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <vue-feather type="user-check" />
                        <span class="menu-title text-truncate" data-i18n="Authentication">Authentication</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="d-flex align-items-center" href="#">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Login">Admin</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="#">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Login">Role</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="#">
                                <vue-feather type="circle" />
                                <span class="menu-item text-truncate" data-i18n="Login">Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
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
    console.log('Update menu collapse');
  }

  const updateMouseHovered = val => {
    isMouseHovered.value = val
  }
</script>

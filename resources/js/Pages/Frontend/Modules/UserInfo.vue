<template>
    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder">{{ $page.props.auth?.user.name }}</span>
            <span class="user-status">{{ $page.props.auth?.user.name }}</span>
        </div><span class="avatar">
                                    <img class="round" src="/frontend/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                                    <span class="avatar-status-online"></span>
                                </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <a class="dropdown-item" href="/dashboard">
            <i class="me-50" data-feather="user"></i> Profile
        </a>
        <a class="dropdown-item" href="app-email.html">
            <i class="me-50" data-feather="mail"></i> Inbox
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="page-account-settings-account.html">
            <i class="me-50" data-feather="settings"></i> Settings
        </a>
        <a class="dropdown-item" href="page-pricing.html">
            <i class="me-50" data-feather="credit-card"></i> Pricing
        </a><a class="dropdown-item" href="page-faq.html">
        <i class="me-50" data-feather="help-circle"></i> FAQ</a>
        <a class="dropdown-item" :href="$page.props.auth.MAIN_URL+'/logout'">
            <i class="me-50" data-feather="power"></i> Logout
        </a>
    </div>
</template>

<script>
export default {
name: "UserInfo"
}
</script>

<style scoped>

</style>

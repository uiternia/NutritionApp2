<script setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
</script>

<template>
    <div>
        <div class="space-x-8 sm:-my-px sm:ml-10 flex py-4 justify-center">
            <JetNavLink :href="route('nutritions.index')" :active="route().current('nutritions.index')">
                <div>栄養管理</div>
            </JetNavLink>
            <JetNavLink :href="route('nutritions.create')" :active="route().current('nutritions.create')">
                <div>普段の食事追加</div>
            </JetNavLink>
            <JetNavLink :href="route('users.index')" :active="route().current('users.index')">
                <div>BMI</div>
            </JetNavLink>
        </div>
    </div>
</template>

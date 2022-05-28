<script setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
</script>

<template>
    <div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <JetNavLink :href="route('post.index')" :active="route().current('post.index')">
                <div>投稿一覧</div>
            </JetNavLink>
            <JetNavLink :href="route('post.create')" :active="route().current('post.create')">
                <div>投稿する</div>
            </JetNavLink>
        </div>
    </div>
</template>

<style scoped>
</style>

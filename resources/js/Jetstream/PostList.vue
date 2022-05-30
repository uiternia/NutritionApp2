<script setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
</script>

<template>
    <div>
        <div class="space-x-8 sm:-my-px sm:ml-10 flex">
            <JetNavLink :href="route('posts.index')" :active="route().current('posts.index')">
                <div>投稿一覧</div>
            </JetNavLink>
            <JetNavLink :href="route('mypost')" :active="route().current('mypost')">
                <div>自分の投稿</div>
            </JetNavLink>
            <JetNavLink :href="route('posts.create')" :active="route().current('posts.create')">
                <div>投稿する</div>
            </JetNavLink>
            <JetNavLink :href="route('favorite.index')" :active="route().current('favorite.index')">
                <div>お気に入り一覧</div>
            </JetNavLink>
        </div>
    </div>
</template>

<style scoped>
</style>

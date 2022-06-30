<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
        <div class="img">
        <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('posts.index')" class="text-sm text-gray-700 underline">
            トップページ
            </Link>
            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                ログイン
                </Link>
                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                会員登録
                </Link>              
            </template>
        </div>
    </div>
</template>

<style scoped>
.img {
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100%;
    background-image: url("/storage/topPc.JPG");
    background-size: cover;
    background-position: center;
}
    
</style>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Jetstream/PostList.vue';

const props = defineProps({
    favorites: Object,
})

</script>

<template>
    <AppLayout title="投稿一覧">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <PostList />
                    <div v-for="favorite in favorites" :key="favorite.id">
                     <Link :href="route('posts.show',favorite.id)">
                    {{favorite.foodname}}
                    </Link>
                    <img :src="favorite.filename">
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

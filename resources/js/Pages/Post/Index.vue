<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination';
import PostList from '../../Jetstream/PostList.vue';

const props = defineProps({
    posts: Object,
})


</script>

<template>
    <AppLayout title="投稿一覧">
        <div class="py-12">
           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <PostList />
                    <div v-for="post in posts.data" :key="post.id">
                    <Link :href="route('posts.show',post.id)">
                    {{post.foodname}}
                    </Link>
                     <img :src="post.filename" />
                    </div>
                    <Pagination class="mt-6" :links="posts.links" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination';
import PostList from '../../Components/PostList.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    posts: Object,
})

const form = useForm({
    keyword: "",
})


const submit = () => {
    form.get(route('post.search'));
}

</script>

<template>
    <AppLayout title="投稿一覧">
        <div class="py-12">
            <div><JetValidationErrors class="validations"/></div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <PostList />
                    <form @submit.prevent="submit">
                        <input type="text" v-model="form.keyword" />
                        <button type="submit">検索する</button>
                    </form>
                    <div v-for="post in posts.data" :key="post.id">
                        <Link :href="route('posts.show', post.id)">
                        {{ post.foodname }}
                        </Link>
                        <img :src="post.filename" />
                    </div>
                    <Pagination class="mt-6" :links="posts.links" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

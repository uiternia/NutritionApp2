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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                <PostList />
                <form @submit.prevent="submit">
                    <div class="flex justify-center text-center">
                        <div class="mr-2"><input class="input" type="text" v-model="form.keyword" /></div>
                        <div><button type="submit"
                                class="px-2 py-2  bg-gray-100 text-lg text-white font-semibold rounded-full hover:bg-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui"
                                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                </svg></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class=" py-6 sm:py-8 lg:py-12">
            <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                <!-- text - start -->
                <div class="mb-10 md:mb-16">
                    <h2 class="text-gray-800 text-xl lg:text-3xl font-bold text-center mb-4 md:mb-6">みんなの投稿</h2>
                </div>
                <!-- text - end -->

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
                    <!-- article - start -->
                    <div  v-for="post in posts.data" :key="post.id" class="flex flex-col bg-white border rounded-lg overflow-hidden">
                    <Link :href="route('posts.show', post.id)">
                        <a class="group h-64 md:h-64 block bg-gray-100 overflow-hidden relative">
                            <img :src="post.filename"
                            loading="lazy" alt="Photo by Minh Pham"
                                class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200"/>
                        </a>
                    </Link>
                        <div class="flex flex-col flex-1 p-4 sm:p-6">
                            <h2 class="text-gray-800 text-lg font-semibold mb-2">
                                <a class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">{{post.foodname}}</a>
                            </h2>
                            <p class="text-gray-500 mb-8">カロリー/{{post.calorie}}kcal</p>
                            <div class="flex justify-between items-end mt-auto">
                                <div class="flex items-center gap-2">
                                    <!-- <div class="w-10 h-10 shrink-0 bg-gray-100 rounded-full overflow-hidden">
                                        <img src="https://images.unsplash.com/photo-1611898872015-0571a9e38375?auto=format&q=75&fit=crop&w=64"
                                            loading="lazy" alt="Photo by Brock Wegner"
                                            class="w-full h-full object-cover object-center" />
                                           <img class="h-10 w-10 rounded-full object-cover" :src="post.profile_photo_url" :alt="post.filename">
                                          
                                    </div> -->
                                    <div>
                                        <span class="block text-indigo-500">{{post.name}}さんの投稿</span>
                                        <!-- <span class="block text-gray-400 text-sm">{{post.created_at}}</span> -->
                                    </div>
                                </div>

                                <span class="text-gray-600 text-sm border rounded px-2 py-1">Article</span>
                            </div>
                        </div>
                    </div>
                    <Pagination class="mt-6 flex justify-center" :links="posts.links" />
                    <!-- article - end -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.input {
    height: 2.4em;
    width: 100%;
    padding: 0 16px;
    border-radius: 4px;
    border: none;
    box-shadow: 0 0 0 1px #ccc inset;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

.input:focus {
    outline: 0;
    box-shadow: 0 0 0 2px rgb(100, 111, 120) inset;
}
</style>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Components/PostList.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination';


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
          <div v-if="posts.data.length === 0">
            <p class="flex justify-center text-xl py-6">検索結果はありませんでした。</p>
          </div>
          <div v-else class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
            <div v-for="post in posts.data" :key="post.id"
              class="flex flex-col bg-white border rounded-lg overflow-hidden">
              <Link :href="route('posts.show', post.id)">
              <a class="group h-64 md:h-64 block bg-gray-100 overflow-hidden relative">
                <img :src="post.filename" loading="lazy" alt="Photo by Minh Pham"
                  class="w-full h-full object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
              </a>
              </Link>
              <div class="flex flex-col flex-1 p-4 sm:p-6">
                <h2 class="text-gray-800 text-lg font-semibold mb-2">
                  <a class="hover:text-indigo-500 active:text-indigo-600 transition duration-100">{{ post.foodname
                  }}</a>
                </h2>
                <p class="text-gray-500 mb-8">カロリー/{{ post.calorie }}kcal</p>

              </div>
            </div>
            <Pagination class="mt-6 flex justify-center" :links="posts.links" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

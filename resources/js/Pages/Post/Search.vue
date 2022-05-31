<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Jetstream/PostList.vue';
import { Link } from '@inertiajs/inertia-vue3'

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
          <div v-if="posts.length === 0">
            <p>検索結果はありませんでした</p>
          </div>
          <div>
            <div v-for="post in posts" :key="post.id">
              <Link :href="route('posts.show', post.id)">
              {{ post.foodname }}
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

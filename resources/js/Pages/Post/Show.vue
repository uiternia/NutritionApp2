<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Jetstream/PostList.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import DialogModal from '../../Jetstream/DialogModal.vue';

const props = defineProps({
  post: Object,
  user: Object,
});

const form = useForm({

});

const isopen = ref(false);

const deletePosts = (id) => {
  form.delete(route("post.destroy",id));
};

</script>

<template>
  <AppLayout title="投稿一覧">
    <div>
      <DialogModal :show="isopen" @close="isopen = false">
        <template #title>
          本当に{{ post.foodname }}の投稿を消去しますか？
        </template>
        <template #footer>
          <button @click="deletePosts(post.id)">はい</button>
          <button @click="isopen = false">いいえ</button>
        </template>
      </DialogModal>
    </div>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <PostList />
          <div>{{ post.foodname }}</div>
          <img :src="post.filename">
          <div v-if="user === post.user_id">
          <button @click="isopen = true">消去する</button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

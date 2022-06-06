<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Components/PostList.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import DialogModal from '../../Jetstream/DialogModal.vue';

const props = defineProps({
  post: Object,
  user: Object,
  favorite: Object,
  favoriteCount: Object,
});

const form = useForm({

});

const isopen = ref(false);

const favoritePost = (id) => {
  form.post(route("favorite.store", id))
}

const favoriteDelete = (id) => {
  form.post(route("favorite.delete", id))
}

const deletePosts = (id) => {
  form.delete(route("posts.destroy", id));
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
          <div>{{ user.name }}の投稿</div>
          <div>{{ post.foodname }}</div>
          <img :src="post.filename">
          <div v-if="user.id === post.user_id">
            <button @click="isopen = true">消去する</button>
          </div>
          <div v-if="favorite === null">
            <button @click="favoritePost(post.id)">お気に入り{{ favoriteCount.length }}</button>
          </div>
          <div v-else>
            <button @click="favoriteDelete(post.id)">お気に入り解除{{ favoriteCount.length }}</button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

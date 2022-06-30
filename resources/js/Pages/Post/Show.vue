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
  type: Object,
  postUser: Object,
});

const form = useForm({

});

const isopen = ref(false);

const favoritePost = (id) => {
  form.post(route("favorite.store", id))
}

const myNutritionadd = (id) => {
  form.post(route("favorite.add", id))
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
          <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
              <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="ヒーロー"
                :src="post.filename">
              <div class="text-center lg:w-2/3 w-full">
                <p class="mb-2 leading-relaxed">{{ type.typeName }}</p>
                <h1 class="title-font sm:text-xl text-3xl mb-4 font-medium text-gray-900">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">{{ post.foodname }}</font>
                  </font>
                </h1>
                <p class="mb-8 leading-relaxed">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">{{ post.content }}</font>
                  </font>
                </p>

                <div class="flex justify-center">
                  <button
                    class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">ボタン</font>
                    </font>
                  </button>
                  <button
                    class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">ボタン</font>
                    </font>
                  </button>
                </div>
              </div>
            </div>
          </section>
          <div>{{ postUser.name }}の投稿</div>
          <div>{{ post.foodname }}</div>
          <div>{{ type.typeName }}</div>
          <img :src="post.filename">
          <div v-if="user.id === post.user_id">
            <button @click="isopen = true">消去する</button>
          </div>
          <div v-if="favorite === null">
            <button @click.prevent="favoritePost(post.id)">お気に入り{{ favoriteCount.length }}</button>
          </div>
          <div v-else>
            <button @click="favoriteDelete(post.id)">お気に入り解除{{ favoriteCount.length }}</button>
          </div>
          <button @click="myNutritionadd(post.id)">普段の食事に追加</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

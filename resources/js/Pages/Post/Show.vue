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
  <AppLayout title="投稿詳細">
    <div>
      <DialogModal :show="isopen" @close="isopen = false">
        <template #title>
          本当に {{ post.foodname }} の投稿を消去しますか？
        </template>
        <template #footer>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
            @click="deletePosts(post.id)">はい</button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
            @click="isopen = false">いいえ</button>
        </template>
      </DialogModal>
    </div>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <PostList />
          <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-12 items-center justify-center flex-col">
              <p class="mb-8 leading-relaxed">
                {{ postUser.name }}さんの投稿
              </p>
              <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="ヒーロー"
                :src="post.filename">
              <div class="text-center lg:w-2/3 w-full">
                <p class="mb-2 leading-relaxed">{{ type.typeName }}</p>
                <h1 class="title-font sm:text-xl text-3xl mb-4 font-medium text-gray-900">
                  {{ post.foodname }}
                </h1>
                <p class="mb-2 leading-relaxed">レシピの説明</p>
                <p class="mb-8 leading-relaxed border-double border-2 border-gray-600">
                  {{ post.content }}
                </p>
                <p class="mb-2 leading-relaxed">カロリー詳細</p>
                <p class="mb-8 leading-relaxed border-double border-2 border-gray-600">
                  カロリー: {{ post.calorie }}kcal <br> タンパク質: {{ post.protein }}g <br> 脂質: {{ post.fat }}g <br> 炭水化物:
                  {{ post.carbon }}g
                </p>
                <div class="flex justify-center">
                  <div class="m-3" v-if="favorite === null">
                    <button @click.prevent="favoritePost(post.id)"
                      class="shadow-lg px-2 py-2  bg-blue-400 text-lg text-white font-semibold rounded  hover:bg-blue-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">お気に入り({{
                          favoriteCount.length
                      }})
                    </button>
                  </div>
                  <div class="m-3" v-else>
                    <button @click="favoriteDelete(post.id)"
                      class="shadow-lg px-2 py-2  bg-red-400 text-lg text-white font-semibold rounded  hover:bg-red-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">
                      お気にり解除
                    </button>
                  </div>

                  <div class="m-3">
                    <button @click="myNutritionadd(post.id)"
                      class="shadow-lg px-2 py-2  bg-green-400 text-lg text-white font-semibold rounded  hover:bg-green-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">普段の食事に追加</button>
                  </div>
                </div>
                <div class="m-3" v-if="user.id === post.user_id">
                  <button @click="isopen = true"
                    class="shadow-lg px-2 py-2  bg-red-400 text-lg text-white font-semibold rounded  hover:bg-red-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">消去</button>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

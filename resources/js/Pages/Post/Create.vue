<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import PostList from '../../Components/PostList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const fileName = ref("")
const url = ref("")
const imageShow = ref(false)


const props = defineProps({
  types: Array,
});

const form = useForm({
  foodname: null,
  file: null,
  postText: null,
  calorie: null,
  carbon: null,
  protein: null,
  fat: null,
  type: 1,
})

const fileSelected = (e) => {
  if (e.target.files.length === 0) {
    url.value = null
    imageShow.value = false
    return false
  }
  fileName.value = e.target.files[0]
  url.value = URL.createObjectURL(fileName.value)
  imageShow.value = true
}

const submit = () => {
  form.post(route('posts.store'))
}


</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
      <JetValidationErrors class="mb-4" />
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <PostList />
          <form @submit.prevent="submit">
            <div class="content">
              <p class="label font-mono">食事の写真を選択</p>
              <input class="input-file" type="file" @input="form.file = $event.target.files[0]" @change="fileSelected"
                accept="image/png, image/jpeg" />
              <div v-if="imageShow" class="file-size">
                <img class="image" :src="url" alt="">
              </div>
              <p class="form-content font-mono">食事の記録</p>
              <textarea class="input-content" v-model="form.postText" rows="5" cols="30"></textarea>
              <p class="form-content font-mono">料理の名前</p>
              <input type="text" class="input-calorie" v-model="form.foodname" />
              <p class="form-content font-mono">食事のカロリー</p>
              <input type="number" class="input-calorie" step="0.1" v-model="form.calorie" />kcal
              <p class="form-content font-mono">炭水化物</p>
              <input type="number" class="input-calorie" step="0.1" v-model="form.carbon" />kcal
              <p class="form-content font-mono">食事のタンパク質</p>
              <input type="number" class="input-calorie" step="0.1" v-model="form.protein" />kcal
              <p class="form-content font-mono">食事の脂質</p>
              <input type="number" class="input-calorie" step="0.1" v-model="form.fat" />kcal
              <select v-model="form.type" name="type">
                <option v-for="type in types" :value="type.id" :key="type.id">
                  {{ type.typeName }}
                </option>
              </select>
              <button type="submit">投稿する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  margin-bottom: 20px;
}

.label {
  margin-bottom: 10px;
  color: rgb(76, 5, 5);
}

.image {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.input-file {
  margin-bottom: 4px;
}

.file-size {
  height: 200px;
  width: 300px;
}

.form-content {
  margin-top: 20px;
  margin-bottom: 10px;
  color: rgb(76, 5, 5);
}

.input-calorie {
  height: 2rem;
  padding: 0 16px;
  border-radius: 4px;
  border: none;
  box-shadow: 0 0 0 1px #ccc inset;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.input-calorie:focus {
  outline: 0;
  box-shadow: 0 0 0 2px rgb(33, 150, 243) inset;
}

.input-content {
  border-radius: 4px;
  border: none;
  box-shadow: 0 0 0 1px #ccc inset;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.input-content:focus {
  outline: 0;
  box-shadow: 0 0 0 2px rgb(33, 150, 243) inset;
}
</style>

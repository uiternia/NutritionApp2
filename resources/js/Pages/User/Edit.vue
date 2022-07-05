<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const props = defineProps({
  user: Object
})

const form = useForm({
  height: props.user.height,
  weight: props.user.weight,
  male: props.user.male,
  mets: props.user.mets,
});

const submit = () => {
  form.put(route('users.update', props.user.id));
}

</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
           <JetValidationErrors class="mb-4 ml-4" />
          <form @submit.prevent="submit">
            <section class="text-gray-600 body-font relative">
              <div class="container px-5 py-4 mx-auto">
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                  <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="height" class="leading-7 text-sm text-gray-600">身長(cm)</label>
                        <input type="number" step="0.1" id="height" name="height" v-model="form.height"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="weight" class="leading-7 text-sm text-gray-600">体重(kg)</label>
                        <input type="number" step="0.1" id="weight" name="weight" v-model="form.weight"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="male" class="leading-7 text-sm text-gray-600">性別</label> <br>
                        <div class="flex text-center">
                          <div><input type="radio" name="male" value="1" v-model="form.male" />男性</div>　<br>
                          <div><input type="radio" name="male" value="0" v-model="form.male" />女性</div>
                        </div>
                      </div>
                    </div>
                    <div class="p-2 w-1/2 mr-5 sm:mr-0">
                      <div class="relative">
                        <label for="mets" class="leading-7 text-sm text-gray-600">普段の運動量</label>
                        <select v-model="form.mets" name="mets" id="mets">
                          <option value="1.5">運動をあまりしない</option>
                          <option value="1.7">運動を少しでも行う</option>
                          <option value="2">普段を運動をする</option>
                        </select>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <button type="submit"
                        class="flex mx-auto mt-4 bg-gradient-to-br from-green-300 to-green-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">登録/更新</button>
                    </div>

                  </div>
                </div>
              </div>
            </section>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

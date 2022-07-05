<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import DialogModal from '../../Jetstream/DialogModal.vue';

const props = defineProps({
  nutrition: Object,
})

const form = useForm({
  cooking: props.nutrition.cooking,
  mycalorie: props.nutrition.mycalorie,
  myfat: props.nutrition.myfat,
  mycarbon: props.nutrition.mycarbon,
  myprotein: props.nutrition.myprotein,
  type: props.nutrition.typeName,
});

const submit = () => {
  form.put(route('nutritions.update', props.nutrition.id));
}

const isopen = ref(false);

const deletePosts = (id) => {
  form.delete(route("nutritions.destroy", id));
};

</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
      <DialogModal :show="isopen" @close="isopen = false">
        <template #title>
          本当に{{ nutrition.cooking }}の投稿を消去しますか？
        </template>
        <template #footer>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
            @click="deletePosts(nutrition.id)">はい</button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
            @click="isopen = false">いいえ</button>
          
        </template>
      </DialogModal>
      <JetValidationErrors class="mb-4" />
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
          <form @submit.prevent="submit">
             <section class="text-gray-600 body-font relative">
              <div class="container px-5 py-4 mx-auto">
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                  <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="cookName" class="leading-7 text-sm text-gray-600">料理名</label>
                        <input type="text" step="0.1" id="cookName" name="cookName" v-model="form.cooking"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="calorie" class="leading-7 text-sm text-gray-600">カロリー(kcal)</label>
                        <input type="number" id="calorie" name="calorie" v-model="form.mycalorie"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="carbon" class="leading-7 text-sm text-gray-600">炭水化物量(g)</label>
                        <input type="number" step="0.1" id="carbon" name="carbon" v-model="form.mycarbon"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="protein" class="leading-7 text-sm text-gray-600">タンパク質量(g)</label>
                        <input type="number" step="0.1" id="protein" name="protein" v-model="form.myprotein"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="fat" class="leading-7 text-sm text-gray-600">脂質量(g)</label>
                        <input type="number" step="0.1" id="fat" name="fat" v-model="form.myfat"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                   
                    <div class="p-2 w-full">
                      <button type="submit"
                        class="flex mx-auto mt-4 bg-gradient-to-br from-green-300 to-green-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">更新</button>
                    </div>
                  </div>
                </div>
              </div>
            </section> 
          </form>
          <button  class="flex mx-auto my-4 bg-gradient-to-br from-red-300 to-red-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2" type="button" @click="isopen = true">消去する</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

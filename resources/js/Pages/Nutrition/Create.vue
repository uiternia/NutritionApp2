<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
const props = defineProps({
  types: Array,
});
</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
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
                        <input type="number" id="calorie" name="calorie" v-model="form.calorie"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="carbon" class="leading-7 text-sm text-gray-600">炭水化物量(g)</label>
                        <input type="number" step="0.1" id="carbon" name="carbon" v-model="form.carbon"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="protein" class="leading-7 text-sm text-gray-600">タンパク質量(g)</label>
                        <input type="number" step="0.1" id="protein" name="protein" v-model="form.protein"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="fat" class="leading-7 text-sm text-gray-600">脂質量(g)</label>
                        <input type="number" step="0.1" id="fat" name="fat" v-model="form.fat"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <label for="type" class="leading-7 text-sm text-gray-600">料理の種類</label>
                        <select v-model="form.type" name="type"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <option v-for="type in types" :value="type.id" :key="type.id">
                            {{ type.typeName }}
                          </option>
                        </select>
                    </div>
                    <div class="p-2 w-full">
                      <button type="submit"
                        class="flex mx-auto mt-4 bg-gradient-to-br from-green-300 to-green-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">追加</button>
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

<script>
export default {
  data() {
    return {
      form: {
        cooking: '',
        calorie: '',
        fat: '',
        carbon: '',
        protein: '',
        type: 1,
      },
    }
  },
  methods: {
    submit() {
      this.$inertia.visit(this.route('nutritions.store', this.form), { method: 'post' })
    },
  }
}
</script>
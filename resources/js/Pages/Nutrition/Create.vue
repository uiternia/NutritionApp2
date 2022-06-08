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
            <div class="content">
              <p class="form-content font-mono">料理の名前</p>
              <input type="text" class="input-calorie" v-model="form.cooking" />
              <p class="form-content font-mono">食事のカロリー</p>
              <input type="number" class="input-calorie" v-model="form.calorie" />kcal
              <p class="form-content font-mono">炭水化物</p>
              <input type="number" step="0.1" class="input-calorie" v-model="form.carbon" />kcal
              <p class="form-content font-mono">食事のタンパク質</p>
              <input type="number" step="0.1" class="input-calorie" v-model="form.protein" />kcal
              <p class="form-content font-mono">食事の脂質</p>
              <input type="number" step="0.1" class="input-calorie" v-model="form.fat" />kcal
              <select v-model="form.type" name="type"
                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
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
      form : {
        cooking: '',
        calorie: '',
        fat: '',
        carbon: '',
        protein: '',
      },
    }
  },
  methods: {
    submit() {
      this.$inertia.visit(this.route('nutritions.store',this.form),{method: 'post'})
    },
  }
}
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import { useForm } from '@inertiajs/inertia-vue3';

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
    form.put(route('users.update',props.user.id));
}

</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
          <form @submit.prevent="submit">
          <p class="form-content font-mono">身長</p>
          <input type="number" step="0.1" class="input-calorie" v-model="form.height" />
          <p class="form-content font-mono">体重</p>
          <input type="number" step="0.1" class="input-calorie" v-model="form.weight" />
          <p class="form-content font-mono">性別</p>
          女性<input type="radio" name="male" value="1" class="input-calorie" v-model="form.male" />
          男性<input type="radio" name="male" value="0" class="input-calorie" v-model="form.male" />
          <label for="mets">選択してください</label>
          <select v-model="form.mets" name="mets" id="mets">
            <option value="1.5">運動をあまりしない</option>
            <option value="1.7">運動を少しでも</option>
            <option value="2">運動をする</option>
          </select>
          <button type="submit">更新</button>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

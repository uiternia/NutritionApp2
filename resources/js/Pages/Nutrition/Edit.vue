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
  calorie: props.nutrition.mycalorie,
  fat: props.nutrition.myfat,
  carbon: props.nutrition.mycarbon,
  protein: props.nutrition.myprotein,
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
          <button @click="deletePosts(nutrition.id)">はい</button>
          <button @click="isopen = false">いいえ</button>
        </template>
      </DialogModal>
      <JetValidationErrors class="mb-4" />
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
          <form @submit.prevent="submit">
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
            
            <button type="submit">更新する</button>
          </form>
          <button type="button" @click="isopen = true">消去する</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

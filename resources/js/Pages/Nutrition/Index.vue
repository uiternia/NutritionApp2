<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const props = defineProps({
  user: Object,
  nutritions: Object,
})

const todayMeal = ref([])

const todayCarorie = computed(() => {
  return todayMeal.value.reduce(
    (sum, i) => sum + (i.mycalorie || 0),
    Number()
  );
})

const todayCarbon = computed(() => {
  return todayMeal.value.reduce(
    (sum, i) => sum + (i.mycarbon || 0),
    Number()
  );
})

const todayProtein = computed(() => {
  return todayMeal.value.reduce(
    (sum, i) => sum + (i.myprotein || 0),
    Number()
  );
})

const todayFat = computed(() => {
  return todayMeal.value.reduce(
    (sum, i) => sum + (i.myfat || 0),
    Number()
  );
})


//以下user情報に指定のデータがあれば計算して必要栄養量の算出 componentに切り分けたい

const baseMetabolism = computed(() => {
  if (props.user.male == 0) {
    return Math.trunc(10.8 * props.user.weight + 620);
  } else {
    return Math.trunc(14.1 * props.user.weight + 620);
  }
})

const requirementCalorie = computed(() => {
  return baseMetabolism.value * props.user.mets;
})

const requireFat = computed(() => {
  return (Math.round((requirementCalorie.value * 0.25) / 9) * 10) / 10;
})

const requireProtein = computed(() => {
  return (Math.round((requirementCalorie.value * 0.15) / 4) * 10) / 10;
})

const requireCarbon = computed(() => {
  return (Math.round((requirementCalorie.value - (requireProtein.value + requireFat.value)) / 4) * 10) / 10;
})

</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">
      <JetValidationErrors class="mb-4" />
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
          <div v-for="nutrition in nutritions" :key="nutrition.id">
            <Link :href="route('nutritions.edit', nutrition.id)">
            {{ nutrition.cooking }}
            </Link>
            <input type="checkbox" v-model="todayMeal" :value="nutrition">
          </div>
          <br>
          {{ requirementCalorie }}
          <br>
          脂質{{ requireFat }}g
          <br>
          タンパク質{{ requireProtein }}g
          <br>
          炭水化物{{ requireCarbon }}g
          <br>
          今日の摂取カロリー {{ todayCarorie }}kcal
          <br>
          今日の摂取糖質量 {{ todayCarbon }}g
          <br>
          今日の摂取タンパク質 {{ todayProtein }}g
          <br>
          今日の摂取脂質 {{ todayFat }}g
        </div>

      </div>

    </div>
  </AppLayout>
</template>

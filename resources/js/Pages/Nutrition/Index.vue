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
  return Math.trunc(baseMetabolism.value * props.user.mets);
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
          <div class="lg:w-2/3 my-4 w-full mx-auto overflow-auto">
            <div class="flex flex-col text-center w-full mb-4">
              <p class="text-l">今日食べたものにチェックを入れましょう!</p>
            </div>
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    料理名(主食)</th>

                  <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                  </th>
                </tr>
              </thead>
              <tbody v-for="nutrition in nutritions" :key="nutrition.id">
              <!-- マジックナンバーの回避 -->
                <tr class="bg-slate-50" v-if="nutrition.type_id === 1">
                  <td class="px-4 py-3">
                    <Link :href="route('nutritions.edit', nutrition.id)">
                    <div class="name text-blue-700">{{ nutrition.cooking }}</div>
                    </Link>
                  </td>
                  <td class="w-10 text-center">
                    <input type="checkbox" v-model="todayMeal" :value="nutrition">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="lg:w-2/3 my-4 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    料理名(主菜)</th>

                  <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                  </th>
                </tr>
              </thead>
              <tbody v-for="nutrition in nutritions" :key="nutrition.id">
                <tr class="bg-orange-50" v-if="nutrition.type_id === 2">
                  <td class="px-4 py-3">
                    <Link :href="route('nutritions.edit', nutrition.id)">
                    <div class="name text-blue-700">{{ nutrition.cooking }}</div>
                    </Link>
                  </td>
                  <td class="w-10 text-center">
                    <input type="checkbox" v-model="todayMeal" :value="nutrition">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="lg:w-2/3 my-4 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    料理名(副菜)</th>

                  <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                  </th>
                </tr>
              </thead>
              <tbody v-for="nutrition in nutritions" :key="nutrition.id">
                <tr class="bg-emerald-50" v-if="nutrition.type_id === 3">
                  <td class="px-4 py-3">
                    <Link :href="route('nutritions.edit', nutrition.id)">
                    <div class="name text-blue-700">{{ nutrition.cooking }}</div>
                    </Link>
                  </td>
                  <td class="w-10 text-center">
                    <input type="checkbox" v-model="todayMeal" :value="nutrition">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="lg:w-2/3 my-4 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    料理名(汁物)</th>

                  <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                  </th>
                </tr>
              </thead>
              <tbody v-for="nutrition in nutritions" :key="nutrition.id">
                <tr class="bg-rose-50" v-if="nutrition.type_id === 4">
                  <td class="px-4 py-3">
                    <Link :href="route('nutritions.edit', nutrition.id)">
                    <div class="name text-blue-700">{{ nutrition.cooking }}</div>
                    </Link>
                  </td>
                  <td class="w-10 text-center">
                    <input type="checkbox" v-model="todayMeal" :value="nutrition">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="lg:w-2/3 my-4 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    料理名(デザート)</th>

                  <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                  </th>
                </tr>
              </thead>
              <tbody v-for="nutrition in nutritions" :key="nutrition.id">
                <tr class="bg-cyan-50" v-if="nutrition.type_id === 5">
                  <td class="px-4 py-3">
                    <Link :href="route('nutritions.edit', nutrition.id)">
                    <div class="name text-blue-700">{{ nutrition.cooking }}</div>
                    </Link>
                  </td>
                  <td class="w-10 text-center">
                    <input type="checkbox" v-model="todayMeal" :value="nutrition">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="flex justify-around my-10">
          <div>
            <p class="text-sm sm:text-2xl py-4 px-1 md:px-4 border-double border-4 border-gray-600">
              必要栄養量 :{{ requirementCalorie }}kcal<br>
              必要糖質量:{{ requireCarbon }}g<br>
              必要蛋白量 :{{ requireProtein }}g<br>
              必要脂質量:{{ requireFat }}g
            </p>
          </div>

          <div>
            <p class="text-sm sm:text-2xl py-4 px-1 md:px-4 border-double border-4 border-gray-600">
              今日の栄養量 :{{ todayCarorie }}kcal<br>
              今日の糖質量:{{ todayCarbon }}g<br>
              今日の蛋白量 :{{ todayProtein }}g<br>
              今日の脂質量:{{ todayFat }}g
            </p>
          </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

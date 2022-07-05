<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from "vue";

const props = defineProps({
  user: Object
})

const bmi = computed(() => {
  if(props.user.height == null || props.user.weight == null){
    return 
  }else{
    return (Math.round(props.user.weight / ((props.user.height / 100) * (props.user.height / 100))* 10) / 10);
  }
})

const standardWeight = computed(() => {
  if(props.user.height == null){
    return
  }else{
    return (Math.round((props.user.height / 100) * (props.user.height / 100) * 22 * 10) /10);
  }
})

</script>

<template>
  <AppLayout title="投稿一覧">
    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <NutritionList />
           <div v-if="bmi === null" class="flex justify-center mx-4">
            <p class="py-2">現在の身長/体重等を登録するとBMI/標準体重を確認できます。<br>また登録後栄養管理の画面に1日の必要栄養量が表示されます。</p>
          </div>
          <div v-else>
          <p class="flex justify-center text-xl py-4 border-dotted border-4 border-gray-600 mx-12">{{user.name}}さんのBMI:{{bmi}}<br>
           {{user.name}}さんの標準体重:{{standardWeight}}kg
          </p>
          </div>
          <div class="flex justify-center py-6">
           <Link :href="route('users.edit', user.id)">
           <button class="mt-4 bg-gradient-to-br from-green-300 to-green-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">登録/更新</button>
          </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

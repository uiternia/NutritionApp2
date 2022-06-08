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
          <Link :href="route('users.edit', user.id)">
          {{ user.name }}
          </Link>
          <br>
          あなたのBMI:{{bmi}}
          <br>
          あなたの標準体重:{{standardWeight}}kg
        </div>
      </div>
    </div>
  </AppLayout>
</template>

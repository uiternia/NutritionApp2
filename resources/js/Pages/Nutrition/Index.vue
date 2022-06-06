<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NutritionList from '../../Components/NutritionList.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    nutritions: Object,
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
          <Link :href="route('nutritions.edit',nutrition.id)">
          {{nutrition.cooking}}
          </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
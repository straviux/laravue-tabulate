<template>
  <div v-if="current == 'all'"><all-news /></div>
  <div v-if="current == 'featured'"><featured-news /></div>
  <div v-if="current == 'drafts'"><draft-news /></div>
  <keep-alive>
    <div v-if="current == 'addnews'"><add-news-form /></div
  ></keep-alive>
</template>
<script setup>
// const current = reactive({ tab: props.current });
import AllNews from "./AllNews.vue";
import FeaturedNews from "./FeaturedNews.vue";
import DraftNews from "./DraftNews.vue";
import AddNewsForm from "./AddNewsForm.vue";
const props = defineProps({
  current: String,
});
</script>

<template>
  <div class="flex flex-col gap-10 p-7">
    <hello-bar />
    <news-menu />
    <div class="-mt-4">
      <!-- <h5 class="text-2xl">All News</h5> -->
    </div>
  </div>
</template>
<script setup>
import HelloBar from "../../components/admin/HelloBar.vue";
import NewsMenu from "../../components/admin/news/NewsMenu.vue";
</script>

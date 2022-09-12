<template>
  <div class="flex flex-col gap-10 p-7">
    <hello-bar />
    <news-menu @tabTarget="getName" />
    <div class="-mt-4">
      <NewsTab :current="currentTab" />
    </div>
  </div>
</template>
<script setup>
import { ref } from "vue";
import HelloBar from "../../components/admin/HelloBar.vue";
import NewsMenu from "../../components/admin/news/NewsMenu.vue";
import NewsTab from "../../components/admin/news/NewsTab.vue";
// import TabsWrapper from "../../components/Tabs/TabsWrapper.vue";
// import Tab from "../../components/Tabs/Tab.vue";
const currentTab = ref("all");
const getName = (value) => {
  currentTab.value = value;
  // console.log(value);
};
</script>

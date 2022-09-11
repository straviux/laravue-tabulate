<template>
  <div class="space-y-7">
    <h3 class="text-3xl">Statistics</h3>

    <div class="flex flex-col md:flex-row gap-4">
      <div
        v-for="({ title, value }, index) in stats"
        :key="index"
        class="bg-stone-200 rounded-xl p-4 flex-1 space-y-10"
      >
        <p class="inline-block text-5xl">{{ value }}</p>
        <h6 class="text-lg">{{ title }}</h6>
      </div>
      <button
        class="hover:bg-white transform hover:translate-y-1 border-2 border-dashed rounded-xl p-4 flex flex-col justify-between items-center"
      >
        <mdicon name="plus" /> <span class="text-lg">New Widget</span>
      </button>
    </div>
  </div>
</template>
<script setup>
const stats = [
  {
    value: "24h",
    title: "Tracked time",
  },
  {
    value: "18",
    title: "Finished Tasks",
  },
];
</script>

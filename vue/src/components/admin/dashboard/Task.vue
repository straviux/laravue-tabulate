<template>
  <div
    class="relative bg-white shadow-orange-50 shadow-2xl p-7 rounded-xl flex"
  >
    <div
      class="absolute top-0 left-0 w-2 h-full rounded-l-xl"
      :class="`bg-${task.color}`"
    ></div>
    <div class="flex-1">
      <h6>{{ task.name }}</h6>
      <p class="text-gray-500">
        {{ task.description }}
        <!-- {{ task.active }} -->
      </p>
    </div>
    <button
      class="flex justify-center items-center w-7 h-7 border rounded-full"
    >
      <mdicon
        name="check"
        v-if="task.active"
        class="rounded-full text-white bg-black"
      />
    </button>
  </div>
</template>
<script setup>
defineProps({
  task: {
    type: Object,
    required: true,
  },
});
</script>

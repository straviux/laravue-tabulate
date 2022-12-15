<template>
  <div
    v-if="notification.show"
    @click="notification.show = false"
    class="absolute w-[360px] right-4 top-4 py-4 px-6 text-white animate-fade-in-down text-[20px] rounded shadow-lg z-50"
    :class="[notification.type === 'success' ? 'bg-emerald-500' : 'bg-red-500']"
  >
    <p class="drop-shadow flex items-top gap-2">
      <mdicon
        :name="
          notification.type === 'success'
            ? 'check-circle-outline'
            : 'close-circle-outline'
        "
        size="30"
        class="mt-1"
      />{{ notification.message }}
    </p>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const notification = computed(() => store.state.notification);
</script>

<style></style>

<template>
  <div class="carousel">
    <slot :currentSlide="currentSlide" />
    <!-- Navigation -->
    <div class="navigate" v-if="navigationEnabled">
      <div class="toggle-page left">
        <svg
          @click="prevSlide"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 27 24"
          stroke-width="2.3"
          stroke="currentColor"
          class="p-1"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15.75 19.5L8.25 12l7.5-7.5"
          />
        </svg>
      </div>
      <div class="toggle-page right">
        <svg
          @click="nextSlide"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 21 24"
          stroke-width="2.3"
          stroke="currentColor"
          class="p-1"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8.25 4.5l7.5 7.5-7.5 7.5"
          />
        </svg>
      </div>
    </div>

    <!-- Pagination -->
    <div class="pagination" v-if="paginationEnabled">
      <span
        v-for="(slide, index) in getSlideCount"
        :key="index"
        :class="{ active: index + 1 === currentSlide }"
        @click="goToSlide(index)"
      >
      </span>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
const props = defineProps({
  startAutoPlay: Boolean,
  timeout: String,
  navigation: Boolean,
  pagination: Boolean,
});
const currentSlide = ref(3);
const getSlideCount = ref(null);
const autoPlayEnabled = ref(
  props.startAutoPlay === undefined ? true : props.startAutoPlay
);
const timeoutDuration = ref(props.timeout === undefined ? 5000 : props.timeout);
const paginationEnabled = ref(
  props.pagination === undefined ? true : props.pagination
);
const navigationEnabled = ref(
  props.navigation === undefined ? true : props.navigation
);

//  next slide
const nextSlide = () => {
  if (currentSlide.value === getSlideCount.value) {
    currentSlide.value = 1;
    return;
  }
  currentSlide.value += 1;
};

// previous slide
const prevSlide = () => {
  if (currentSlide.value === 1) {
    currentSlide.value = getSlideCount.value;
    return;
  }
  currentSlide.value -= 1;
};

// goto Slide
const goToSlide = (index) => {
  currentSlide.value = index + 1;
};

// autoplay Slide
const autoPlay = () => {
  setInterval(() => {
    nextSlide();
  }, timeoutDuration.value);
};

if (autoPlayEnabled.value) {
  autoPlay();
}

onMounted(() => {
  getSlideCount.value = document.querySelectorAll(".slide").length;
  // console.log(getSlideCount.value);
});
</script>

<style lang="scss" scoped>
.navigate {
  padding: 0 16px;
  height: 100%;
  width: 100%;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;

  .toggle-page {
    display: flex;
    flex: 1;
  }

  .right {
    justify-content: flex-end;
  }
  svg {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 1px;
    width: 30px;
    height: 30px;
    background-color: #27b84d;
    color: #fff;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.6);
  }
}

.pagination {
  position: absolute;
  bottom: 4px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 6px;

  span {
    cursor: pointer;
    width: 55px;
    height: 4px;
    border-radius: 2px;
    background-color: #27b84d;
    box-shadow: 0 2px 3px 1px rgb(0 0 0 / 0.1), 0 1px 1px 0 rgb(0 0 0 / 0.4);
  }

  .active {
    background-color: #fff;
  }
}
</style>

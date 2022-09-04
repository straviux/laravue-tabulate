<template>
  <main>
    <!-- Carousel -->
    <Carousel
      class="carousel"
      v-slot="currentSlide"
      :pagination="true"
      :navigation="true"
      :start-auto-play="true"
      :timeout="5000"
    >
      <CarouselSlide v-for="(slide, index) in carouselSlides" :key="index">
        <div
          v-show="currentSlide.currentSlide === index + 1"
          class="slide-info"
        >
          <img :src="getImageUrl(slide)" alt="carousel" />
        </div>
      </CarouselSlide>
    </Carousel>
    <!-- End Carousel -->
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <!-- Replace with your content -->
      <div class="px-4 py-3 sm:px-0">
        <!--Banner-->
        <div className="max-w-6xl mx-auto px-4 sm:px-6">
          <div className="text-center pt-4">
            <h1
              className="text-5xl md:text-6xl font-extrabold leading-tighter tracking-tighter mb-4"
              data-aos="zoom-y-out"
            >
              JCA for Progress
              <span
                className="bg-clip-text text-transparent bg-gradient-to-r from-green-500 to-teal-400"
                >Movement</span
              >
            </h1>
            <div className="max-w-3xl mx-auto">
              <p
                className="text-xl text-gray-600 mb-8"
                data-aos="zoom-y-out"
                data-aos-delay="150"
              >
                An Organization founded by Jose Chaves Alvarez to help the
                community to have better way of living.
              </p>
            </div>
          </div>
        </div>
        <!-- /End Banner-->
      </div>
      <!-- /End replace -->
    </div>
    <div class="py-12 bg-gray-100">test</div>
  </main>
  <footer class="p-4 md:px-6 md:py-8 bg-footer">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" class="flex items-center mb-4 sm:mb-0">
        <img
          src="../assets/img/hor_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
        <img
          src="../assets/img/province_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
        <img
          src="../assets/img/jpm_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
      </a>
      <ul
        class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400"
      >
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
        </li>
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
        </li>
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
        </li>
        <li>
          <a href="#" class="hover:underline">Contact</a>
        </li>
      </ul>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400"
      >© 2022 <a href="#" class="hover:underline">JPM Palawan</a>. All Rights
      Reserved.
    </span>
  </footer>
</template>

<script>
import Carousel from "../components/Carousel.vue";
import CarouselSlide from "../components/CarouselSlide.vue";

export default {
  name: "Home",
  components: {
    Carousel,
    CarouselSlide,
  },
  setup() {
    const carouselSlides = [
      "../assets/img/1.jpg",
      "../assets/img/3.jpg",
      "../assets/img/5.jpg",
    ];
    const getImageUrl = (name) => {
      return new URL(`../img/${name}`, import.meta.url).href;
    };

    return { carouselSlides, getImageUrl };
  },
};
</script>

<style lang="scss" scoped>
.carousel {
  position: relative;
  max-height: 700vh;
  height: 70vh;
}
.slide-info {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  max-height: 100%;
  height: 100%;

  img {
    min-width: 100%;
    height: 100%;
    object-fit: fit;
  }
}
</style>

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
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
        <section
          class="col-span-2 h-fit font-bold tracking-tight bg-white rounded-lg border border-gray-200 shadow-md px-4 py-3"
        >
          <h5
            class="mb-2 mt-2 text-2xl font-bold tracking-tight text-gray-800 dark:text-white border-b py-2 mb-4"
          >
            Latest News
          </h5>

          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white"
            >
              COMELEC opens registration for political parties, partylists
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              All groups and organizations that intend to register as political
              parties for the 2025 National and Local Elections (NLE) may now do
              so with the Commission on Elections.
            </p>
          </a>
          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-xl font-bold tracking-tight text-gray-700 dark:text-white"
            >
              PSA encourages parents to register kids for national ID
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              Getting a national ID could eventually ensure a smoother
              enrollment process for children aged 5 and up, the Philippine
              Statistics Authority (PSA) said Sunday.
            </p>
          </a>
          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-xl font-bold tracking-tight text-gray-700 dark:text-white"
            >
              DOH warns public vs fake messages involving organ trafficking
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              The regional office of the Department of Health (DOH) in MIMAROPA
              alerted the public to fake messages involving organ trafficking.
            </p>
          </a>
          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-xl font-bold tracking-tight text-gray-700 dark:text-white"
            >
              Review of provincial administrative code urged
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              As local government units (LGU) get ready for more
              responsibilities because of the Mandanas-Garcia ruling of the
              Supreme Court, 2nd District Board Member Ryan D. Maminta said that
              the Provincial Administrative Code (PAC) of Palawan also needs to
              be looked at again and changed.
            </p>
          </a>
          <div class="btn-group mt-6">
            <a
              href="#"
              class="inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
              <svg
                aria-hidden="true"
                class="mr-2 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Previous
            </a>
            <a
              href="#"
              class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
              Next
              <svg
                aria-hidden="true"
                class="ml-2 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </a>
          </div>
        </section>

        <section
          class="h-fit font-bold tracking-tight bg-white rounded-lg border border-gray-200 shadow-md px-4 py-3"
        >
          <h5
            class="mb-2 mt-2 text-2xl font-bold tracking-tight text-gray-800 dark:text-white border-b py-2 mb-4"
          >
            Featured
          </h5>

          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-lg font-bold tracking-tight text-gray-700 dark:text-white"
            >
              IATF ‘carefully studying’ proposals to relax mask mandate: DILG
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              Department of the Interior and Local Government (DILG) Secretary
              Benjamin Abalos Jr. on Tuesday said the Inter-Agency Task Force
              for the Management of Emerging Infectious Diseases (IATF) is
              carefully studying the proposals to relax the country’s mask
              mandate.
            </p>
          </a>
          <a
            href="#"
            class="block p-3 border-b-2 border-gray-200 mb-1 hover:bg-blue-100"
          >
            <h5
              class="mb-2 text-lg font-bold tracking-tight text-gray-700 dark:text-white"
            >
              Senate prioritizes ratification of SIM card registration bill
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              Senators JV Ejercito and Grace Poe are pushing for the
              ratification of the SIM Card Registration bill while more senators
              want to investigate anew the proliferation of scams via text
              messages.
            </p>
          </a>
          <div class="btn-group mt-6">
            <a
              href="#"
              class="inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
              <svg
                aria-hidden="true"
                class="mr-2 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Previous
            </a>
            <a
              href="#"
              class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
              Next
              <svg
                aria-hidden="true"
                class="ml-2 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </a>
          </div>
        </section>
      </div>
    </div>
  </main>
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

<template>
  <main>
    <!-- Carousel -->
    <Carousel
      class="carousel h-80 lg:h-screen"
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
          class="col-span-2 h-fit font-bold tracking-tight bg-white rounded border border-gray-200 shadow-md px-4 py-3"
        >
          <h5>Latest</h5>
          <a
            href=""
            class="card card-compact card-side hover:bg-blue-100 rounded-none px-4 border-b mb-4 py-3"
          >
            <figure class="bg-gray-600">
              <img
                src="https://placeimg.com/600/600/arch"
                class="h-40 w-40 w-fit"
                alt="Movie"
              />
            </figure>
            <div class="card-body">
              <h5 class="mb-2 md:text-xl text-gray-700">
                COMELEC opens registration for political parties, partylists
              </h5>
              <p class="font-normal text-gray-700 hidden md:block">
                All groups and organizations that intend to register as
                political parties for the 2025 National and Local Elections
                (NLE) may now do so with the Commission on Elections.
              </p>

              <!-- TAGS -->
              <div class="card-actions lg:justify-end pt-8 tags py-3">
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 6h.008v.008H6V6z"
                    />
                  </svg>

                  Provincial News
                </div>
                <!-- <div class="badge badge-xs badge-ghost py-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="2 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                      </svg>
                      Arcee Heredero
                    </div> -->
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>

                  September 07, 2022
                </div>
              </div>
              <!-- end of TAGS -->
            </div>
          </a>

          <a
            href=""
            class="card card-compact card-side hover:bg-blue-100 rounded-none px-4 border-b mb-4 py-3"
          >
            <figure>
              <img
                src="https://placeimg.com/200/280/tech"
                class="h-40 w-40"
                alt="Movie"
              />
            </figure>
            <div class="card-body">
              <h5 class="mb-2 md:text-xl text-gray-700">
                Review of provincial administrative code urged
              </h5>
              <p class="font-normal text-gray-700 hidden md:block">
                As local government units (LGU) get ready for more
                responsibilities because of the Mandanas-Garcia ruling of the
                Supreme Court, 2nd District Board Member Ryan D. Maminta said
                that the Provincial Administrative Code (PAC) of Palawan also
                needs to be looked at again and changed.
              </p>
              <!-- TAGS -->
              <div class="card-actions lg:justify-end pt-8 tags py-3">
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 6h.008v.008H6V6z"
                    />
                  </svg>

                  Provincial News
                </div>
                <!-- <div class="badge badge-xs badge-ghost py-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="2 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                      </svg>
                      Arcee Heredero
                    </div> -->
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>

                  September 07, 2022
                </div>
              </div>
              <!-- end of TAGS -->
            </div>
          </a>
          <a
            href=""
            class="card card-compact card-side hover:bg-blue-100 rounded-none px-4 border-b mb-4 py-3"
          >
            <figure>
              <img
                src="https://placeimg.com/200/280/nature"
                class="h-40 w-40"
                alt="Movie"
              />
            </figure>
            <div class="card-body">
              <h5 class="mb-2 md:text-xl text-gray-700">
                PSA encourages parents to register kids for national ID
              </h5>
              <p class="font-normal text-gray-700 hidden md:block">
                Getting a national ID could eventually ensure a smoother
                enrollment process for children aged 5 and up, the Philippine
                Statistics Authority (PSA) said Sunday.
              </p>
              <!-- TAGS -->
              <div class="card-actions lg:justify-end pt-8 tags py-3">
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 6h.008v.008H6V6z"
                    />
                  </svg>

                  Provincial News
                </div>
                <!-- <div class="badge badge-xs badge-ghost py-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="2 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                      </svg>
                      Arcee Heredero
                    </div> -->
                <div class="badge badge-xs badge-ghost py-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="2 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>

                  September 07, 2022
                </div>
              </div>
              <!-- end of TAGS -->
            </div>
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
          class="col-span-2 lg:col-span-1 h-fit w-full font-bold tracking-tight bg-white rounded-lg border border-gray-200 shadow-md px-4 py-3"
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
  max-height: 70vh;
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

<template>
  <div
    class="bg-no-repeat bg-cover bg-center relative"
    style="
      background-image: url(https://img.wallpapersafari.com/desktop/1680/1050/60/67/BhYL58.jpg);
    "
  >
    <div
      class="absolute bg-gradient-to-b from-blue-600 to-green-400 opacity-75 inset-0 z-0"
    ></div>
    <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
      <div
        class="flex-col flex self-center p-10 sm:max-w-5xl xl:max-w-2xl z-10"
      >
        <div class="self-start hidden lg:flex flex-col text-white">
          <!--Banner-->
          <div className="max-w-6xl mx-auto px-4 sm:px-6">
            <div className="text-center pb-3 pt-4">
              <h1
                className="text-5xl md:text-6xl font-extrabold leading-tighter tracking-tighter mb-4 drop-shadow-lg"
                data-aos="zoom-y-out"
              >
                JCA for Progress
                <span
                  className="bg-clip-text text-transparent bg-gradient-to-r from-green-500 to-teal-400 drop-shadow-lg"
                  >Movement</span
                >
              </h1>
              <div className="max-w-3xl mx-auto">
                <p
                  className="text-xl text-gray-100 mb-8"
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
      </div>
      <div class="flex justify-center self-center z-10">
        <div class="p-12 bg-white mx-auto rounded-2xl w-100">
          <div class="mb-4">
            <a
              href="#"
              @click="$router.go(-1)"
              class="float-right mt-2 underline cursor-pointer text-green-600"
              >Go Back</a
            >
            <h3 class="font-semibold text-2xl text-gray-800">Sign Up</h3>
            <p class="text-gray-500">Create your account.</p>
          </div>
          <div class="space-y-5">
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Fullname</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type=""
                placeholder="Enter your fullname"
              />
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Username</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type=""
                placeholder="Enter your username"
              />
            </div>
            <div class="space-y-2">
              <label
                class="mb-5 text-sm font-medium text-gray-700 tracking-wide"
              >
                Password
              </label>
              <input
                class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type=""
                placeholder="Enter your password"
              />
            </div>

            <div>
              <button
                type="submit"
                class="w-full flex justify-center bg-green-400 hover:bg-green-500 text-gray-100 p-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500"
              >
                Submit
              </button>
            </div>
          </div>
          <div class="flex items-center justify-between pt-5">
            <div class="text-sm">
              Existing user?

              <router-link
                :to="'login'"
                class="text-green-400 hover:text-green-500"
                >Sign in</router-link
              >
            </div>
          </div>
          <div class="pt-5 text-center text-gray-400 text-xs">
            <span> Copyright © 2022-2023</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Register",
};
</script>

<style scoped></style>

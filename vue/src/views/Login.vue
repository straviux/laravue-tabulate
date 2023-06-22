<template>
  <div class="bg-no-repeat bg-cover bg-center relative" id="login-container">
    <div
      class="absolute bg-gradient-to-b from-cyan-600 to-blue-400 opacity-75 inset-0 z-0"
    ></div>
    <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
      <div class="flex justify-center self-center z-10">
        <div class="p-12 bg-white mx-auto rounded-2xl w-100">
          <div class="mb-4">
            <h3 class="font-semibold text-2xl text-gray-800">Sign In</h3>
            <p class="text-gray-500 mt-1">Please sign in to your account.</p>
          </div>
          <!-- BEGIN LOGIN FORM -->
          <form class="space-y-5 mt-4" @submit="login">
            <div
              v-if="errorMessage"
              class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800 flex items-center justify-between"
              role="alert"
            >
              {{ errorMessage }}
              <span
                @click="errorMessage = ''"
                class="border border-red-600 ml-2 rounded-full transition-colors cursor-pointer hover:text-red-800 hover:border-red-800"
              >
                <mdicon name="close" size="17"
              /></span>
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Username</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="text"
                required
                v-model="user.username"
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
                type="password"
                v-model="user.password"
                required
                placeholder="Enter your password"
              />
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input
                  id="remember_me"
                  name="remember_me"
                  type="checkbox"
                  v-model="user.remember"
                  class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded"
                />
                <label
                  for="remember_me"
                  class="ml-2 block text-sm text-gray-800"
                >
                  Remember me
                </label>
              </div>
              <div class="text-sm">
                <a href="#" class="text-green-400 hover:text-green-500">
                  Forgot your password?
                </a>
              </div>
            </div>
            <div>
              <button
                type="submit"
                class="w-full flex justify-center bg-green-400 hover:bg-green-500 text-gray-100 p-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500"
              >
                Sign in
              </button>
            </div>
          </form>
          <div class="pt-5 text-center text-gray-400 text-xs">
            <span> Copyright © 2022-2023</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import store from "../store";
import { useRouter } from "vue-router";
import { ref } from "vue";

const router = useRouter();
const user = {
  username: "",
  password: "",
  remember: false,
};

let errorMessage = ref("");

const login = (ev) => {
  ev.preventDefault();
  if (!user.username || !user.password) {
    return;
  }
  store
    .dispatch("login", user)
    .then(() => {
      router.push({ name: "Admin" });
    })
    .catch((err) => {
      console.log(err);
      errorMessage.value = err.response.data.error;
    });
};
</script>
<style lang="scss" scoped>
#login-container {
  background-image: url("../assets/img/login_bg.jpg");
}
</style>

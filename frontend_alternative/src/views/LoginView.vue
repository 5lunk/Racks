<template>
  <div class="min-h-screen">
    <div
      class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0"
    >
      <div
        class="w-full rounded-lg bg-white shadow dark:border dark:border-gray-700 dark:bg-gray-800 sm:max-w-md md:mt-0 xl:p-0"
      >
        <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
          <h1
            class="text-xl leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl"
          >
            Authentication
          </h1>
          <template v-if="loginError.length">
            <text class="text-xs text-red-500">
              {{ loginError }}
            </text>
          </template>
          <form class="space-y-4 md:space-y-6" v-on:submit.prevent="submitForm">
            <div>
              <label
                for="name"
                class="mb-2 block text-sm text-gray-900 dark:text-white"
              >
                Username:
              </label>
              <input
                v-model="name"
                name="name"
                id="e2e_username"
                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                placeholder="username"
                required=""
              />
            </div>
            <div>
              <label
                for="password"
                class="mb-2 block text-sm text-gray-900 dark:text-white"
              >
                Password:
              </label>
              <input
                v-model="password"
                type="password"
                name="password"
                id="e2e_password"
                placeholder="••••••••"
                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                required=""
              />
            </div>
            <button
              type="submit"
              id="e2e_login"
              class="focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-4"
            >
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { BASE_PATH, RESPONSE_STATUS } from '@/constants';

export default {
  name: 'LoginView',
  data() {
    return {
      name: '',
      password: '',
      loginError: '',
    };
  },
  methods: {
    /**
     * Submit form
     */
    submitForm() {
      const formData = {
        name: this.name,
        password: this.password,
      };
      // Get and store token
      axios
        .post(`${BASE_PATH}/login`, formData)
        .then((response) => {
          const token = response.data.access_token;
          this.$store.commit('setToken', token);
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
          localStorage.setItem('token', token);
          this.$router.push({ name: 'TreeView' });
        })
        .catch((error) => {
          if (error.response.status === RESPONSE_STATUS.UNAUTHORIZED) {
            this.loginError = "We couldn't verify your account details";
          } else {
            this.loginError =
              'Something went wrong, please refresh and try again';
          }
        });
    },
  },
};
</script>

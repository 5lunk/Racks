<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-blue-800 mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <router-link :to="{path: '/'}">
          <img
            alt="Logo"
            class="object-fill h-16 w-32"
            :src="mySVG"
          />
        </router-link>
      <div
        class="lg:flex flex-grow items-center"
        id="example-navbar-warning"
      >
        <ul class="flex flex-col lg:flex-row list-none ml-auto">
          <li class="nav-item">
            <button
              type="submit"
              id="button"
              v-on:click="logout">
              <a class="px-3 py-2 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75">
                Logout
              </a>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="text-right text-xs text-slate-400 mr-5 py-0">
    <button
      v-on:click="downloadReport('devices', 'devices.csv')"
      class="mr-2 text-blue-500 hover:text-blue-700"
    >
      devices.csv &#8681;
    </button>
    <button
      v-on:click="downloadReport('racks', 'racks.csv')"
      class="mr-2 text-blue-500 hover:text-blue-700"
    >
      racks.csv &#8681;
    </button>
    <button
      v-on:click="downloadReport('rooms', 'rooms.csv')"
      class="mr-2 text-blue-500 hover:text-blue-700"
    >
      rooms.csv &#8681;
    </button>
    you are logged in as <u>{{user}}</u>
  </div>
</template>

<script>
import {getUnique, logIfNotStatus} from "@/api";
import {RESPONSE_STATUS} from "@/constants";
import axios from "axios";

export default {
  name: 'TheHeader',
  data() {
    return {
      mySVG: require('@/assets/logo-svg.svg'),
      user: ''
    }
  },
  created() {
    this.setUser()
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      sessionStorage.removeItem('user');
      this.$router.push('/login');
    },
    /**
     * Download report
     * @param {String} reportName Report name
     * @param {String} fileName File name
     */
    async downloadReport(reportName, fileName) {
      alert('Download will start in a few seconds');
      await axios({
        url: `${process.env.VUE_APP_AXIOS_URL}/api/${process.env.VUE_APP_API_VERSION}/auth/export/${reportName}`,
        method: 'GET',
        responseType: 'blob',
      })
        .then(response => {
          const data = new Blob([response.data]);
          const downloadUrl = window.URL.createObjectURL(data);
          const link = document.createElement('a');
          link.href = downloadUrl;
          link.setAttribute('download', fileName);
          document.body.appendChild(link);
          link.click();
          link.remove();
        });
    },
    /**
     * Fetch and set user
     */
    async setUser() {
      if (sessionStorage.hasOwnProperty('user')) {
        this.user = sessionStorage.getItem('user');
        return
      }
      const response = await getUnique('user', 'user');
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      this.user = response.data.data.name;
      sessionStorage.setItem('user', this.user);
    }
  }
}
</script>

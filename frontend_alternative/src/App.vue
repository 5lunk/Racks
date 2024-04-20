<template>
  <div id="App">
    <template v-if="$route.name !== 'LoginView'">
      <TheHeader />
    </template>
    <router-view />
  </div>
</template>

<script>
import TheHeader from '@/components/TheHeader.vue';

export default {
  name: 'App',
  components: {
    TheHeader,
  },
  computed: {
    tokenRefreshed() {
      return this.$store.getters.tokenRefreshed;
    },
    loggedOut() {
      return this.$store.getters.loggedOut;
    },
    tokenNeedsRefresh() {
      return this.$store.getters.tokenNeedsRefresh;
    },
  },
  watch: {
    tokenRefreshed(refreshed) {
      if (refreshed) {
        this.$router.go();
      }
    },
    loggedOut(out) {
      if (out) {
        this.$router.push({ name: 'LoginView' });
      }
    },
    tokenNeedsRefresh(needs) {
      if (needs) {
        this.$store.dispatch('refreshToken');
      }
    },
  },
};
</script>

<style lang="scss">
#app {
  background-color: #f4f8fe;
  background-image: radial-gradient(
      circle at 100% 150%,
      #f4f8fe 24%,
      white 24%,
      white 28%,
      #f4f8fe 28%,
      #f4f8fe 36%,
      white 36%,
      white 40%,
      transparent 40%,
      transparent
    ),
    radial-gradient(
      circle at 0 150%,
      #f4f8fe 24%,
      white 24%,
      white 28%,
      #f4f8fe 28%,
      #f4f8fe 36%,
      white 36%,
      white 40%,
      transparent 40%,
      transparent
    ),
    radial-gradient(
      circle at 50% 100%,
      white 10%,
      #f4f8fe 10%,
      #f4f8fe 23%,
      white 23%,
      white 30%,
      #f4f8fe 30%,
      #f4f8fe 43%,
      white 43%,
      white 50%,
      #f4f8fe 50%,
      #f4f8fe 63%,
      white 63%,
      white 71%,
      transparent 71%,
      transparent
    ),
    radial-gradient(
      circle at 100% 50%,
      white 5%,
      #f4f8fe 5%,
      #f4f8fe 15%,
      white 15%,
      white 20%,
      #f4f8fe 20%,
      #f4f8fe 29%,
      white 29%,
      white 34%,
      #f4f8fe 34%,
      #f4f8fe 44%,
      white 44%,
      white 49%,
      transparent 49%,
      transparent
    ),
    radial-gradient(
      circle at 0 50%,
      white 5%,
      #f4f8fe 5%,
      #f4f8fe 15%,
      white 15%,
      white 20%,
      #f4f8fe 20%,
      #f4f8fe 29%,
      white 29%,
      white 34%,
      #f4f8fe 34%,
      #f4f8fe 44%,
      white 44%,
      white 49%,
      transparent 49%,
      transparent
    );
  background-size: 75%;
  background-attachment: scroll;
}
</style>

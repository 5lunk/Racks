<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="message" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-sm font-light"
    >
      <DeviceForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import DeviceForm from '@/components/Device/DeviceForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'DeviceUpdateView',
  components: {
    DeviceForm,
    TheMessage,
  },
  created() {
    this.$store.dispatch('getDevice', parseInt(this.$route.params.id));
  },
  computed: {
    form() {
      return this.$store.getters.device;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  methods: {
    /**
     * Submit device form
     * @param {Object} form Device form
     */
    submitForm(form) {
      this.$store.dispatch('submitDeviceFormForUpdate', {
        form: form,
        id: parseInt(this.$route.params.id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

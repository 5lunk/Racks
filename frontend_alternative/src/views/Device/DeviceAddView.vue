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
      <DeviceForm :form="device" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import DeviceForm from '@/components/Device/DeviceForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'DeviceAddView',
  components: {
    DeviceForm,
    TheMessage,
  },
  computed: {
    device() {
      return this.$store.getters.device;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  methods: {
    /**
     * Submit device form
     * @param {Object} form device form
     */
    submitForm(form) {
      this.$store.dispatch('submitDeviceFormForCreate', {
        form: form,
        rackId: parseInt(this.$route.params.rack_id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

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
      <RackForm :form="form" :update="true" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import RackForm from '@/components/Rack/RackForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'RackUpdateView',
  components: {
    RackForm,
    TheMessage,
  },
  created() {
    this.$store.dispatch('getRack', parseInt(this.$route.params.id));
  },
  computed: {
    form() {
      return this.$store.getters.rack;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  methods: {
    /**
     * Submit rack form
     * @param {Object} form Rack form
     */
    submitForm(form) {
      this.$store.dispatch('submitRackFormForUpdate', {
        form: form,
        id: parseInt(this.$route.params.id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

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
      <RackForm :form="rack" :update="false" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import RackForm from '@/components/Rack/RackForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'RackAddView',
  components: {
    RackForm,
    TheMessage,
  },
  computed: {
    rack() {
      return this.$store.getters.rack;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  created() {
    this.$store.commit('setRackDefaults');
  },
  methods: {
    /**
     * Submit rack form
     * @param {Object} form rack form
     */
    submitForm(form) {
      this.$store.dispatch('submitRackFormForCreate', {
        form: form,
        roomId: parseInt(this.$route.params.room_id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

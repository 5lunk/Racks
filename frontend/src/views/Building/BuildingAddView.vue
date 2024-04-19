<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="buildingMessage" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-sm font-light"
    >
      <BuildingForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import BuildingForm from '@/components/Building/BuildingForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'BuildingAddView',
  components: {
    BuildingForm,
    TheMessage,
  },
  computed: {
    form() {
      return this.$store.getters.building;
    },
    buildingMessage() {
      return this.$store.getters.buildingMessage;
    },
  },
  methods: {
    /**
     * Submit building form
     * @param {Object} form Building form
     */
    submitForm(form) {
      this.$store.dispatch('submitBuildingFormForCreate', {
        form: form,
        siteId: this.$route.params.site_id,
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="message" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-sm font-light"
    >
      <BuildingForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import BuildingForm from '@/components/Building/BuildingForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'BuildingUpdateView',
  components: {
    BuildingForm,
    TheMessage,
  },
  created() {
    this.$store.dispatch('getBuilding', this.$route.params.id);
  },
  computed: {
    form() {
      return this.$store.getters.building;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  methods: {
    /**
     * Submit building form
     * @param {Object} form Building form
     */
    submitForm(form) {
      this.$store.dispatch('submitFormForUpdate', {
        form: form,
        id: this.$route.params.id,
      });
    },
  },
};
</script>

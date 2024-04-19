<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="siteMessage" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-sm font-light"
    >
      <SiteForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import SiteForm from '@/components/Site/SiteForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'SiteAddView',
  components: {
    SiteForm,
    TheMessage,
  },
  computed: {
    form() {
      return this.$store.getters.site;
    },
    siteMessage() {
      return this.$store.getters.siteMessage;
    },
  },
  methods: {
    /**
     * Submit site form
     * @param {Object} form Site form
     */
    submitForm(form) {
      this.$store.dispatch('submitSiteFormForCreate', {
        form: form,
        departmentId: this.$route.params.department_id,
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

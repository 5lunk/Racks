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
import BuildingForm from '@/components/BuildingForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import { getResponseMessage, postObject } from '@/api';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'BuildingAddView',
  components: {
    BuildingForm,
    TheMessage,
  },
  data() {
    return {
      form: {
        name: '',
        description: '',
      },
      message: {
        text: '',
        success: false,
      },
    };
  },
  methods: {
    /**
     * Submit building form
     * @param {Object} form Building form
     */
    async submitForm(form) {
      // If form not valid
      if (form.$errors) {
        this.message.text = '';
        this.message.success = false;
        return;
      }
      // If form valid
      const formData = {
        name: form.name,
        description: form.description,
        site_id: this.$route.params.site_id,
      };
      const response = await postObject('building', formData);
      if (response.status === RESPONSE_STATUS.CREATED) {
        this.message.success = true;
        this.message.text = `Building ${response.data.data.name} added successfully`;
        // Reset form
        this.form.name = '';
        this.form.description = '';
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

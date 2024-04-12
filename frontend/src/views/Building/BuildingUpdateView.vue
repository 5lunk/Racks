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
import { RESPONSE_STATUS } from '@/constants';
import {
  getObject,
  getResponseMessage,
  logIfNotStatus,
  putObject,
} from '@/api';

export default {
  name: 'BuildingUpdateView',
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
  created() {
    this.setOldData();
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
      };
      const response = await putObject(
        'building',
        this.$route.params.id,
        formData,
      );
      if (response.status === RESPONSE_STATUS.ACCEPTED) {
        this.message.success = true;
        this.message.text = `Building ${response.data.data.name} updated successfully`;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    /**
     * Fetch and set building old data
     */
    async setOldData() {
      const response = await getObject('building', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
      this.form.name = response.data.data.name;
      this.form.description = response.data.data.description;
    },
  },
};
</script>

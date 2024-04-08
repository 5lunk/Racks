<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :messageProps="messageProps" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-sm font-light"
    >
      <template v-if="formProps.oldName">
        <SiteForm :formProps="formProps" v-on:on-submit="submitForm" />
      </template>
    </div>
  </div>
</template>

<script>
import SiteForm from '@/components/SiteForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import { RESPONSE_STATUS } from '@/constants';
import {
  getObject,
  getResponseMessage,
  logIfNotStatus,
  putObject,
} from '@/api';

export default {
  name: 'SiteUpdateView',
  components: {
    SiteForm,
    TheMessage,
  },
  data() {
    return {
      formProps: {
        oldName: '',
        oldDescription: '',
      },
      messageProps: {
        message: '',
        success: false,
      },
    };
  },
  async created() {
    await this.setOldData();
  },
  methods: {
    /**
     * Submit site form
     * @param {Object} form Site form
     */
    async submitForm(form) {
      const formData = {
        name: form.name,
        description: form.description,
      };
      const response = await putObject('site', this.$route.params.id, formData);
      if (response.status === RESPONSE_STATUS.ACCEPTED) {
        this.messageProps.success = true;
        this.messageProps.message = `Site ${response.data.data.name} updated successfully`;
      } else {
        this.messageProps.success = false;
        this.messageProps.message = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    /**
     * Fetch and set site old data
     */
    async setOldData() {
      const response = await getObject('site', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      this.formProps.oldName = response.data.data.name;
      this.formProps.oldDescription = response.data.data.description;
    },
  },
};
</script>

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
      <RoomForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import RoomForm from '@/components/Room/RoomForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import { getResponseMessage, postObject } from '@/api';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'RoomAddView',
  components: {
    RoomForm,
    TheMessage,
  },
  data() {
    return {
      form: {
        name: '',
        buildingFloor: '',
        description: '',
        numberOfRackSpaces: null,
        area: null,
        responsible: '',
        coolingSystem: 'Centralized',
        fireSuppressionSystem: 'Centralized',
        accessIsOpen: false,
        hasRaisedFloor: false,
      },
      message: {
        text: '',
        success: false,
      },
    };
  },
  methods: {
    /**
     * Submit room form
     * @param {Object} form Room form
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
        building_floor: form.buildingFloor,
        description: form.description,
        number_of_rack_spaces: form.numberOfRackSpaces,
        area: form.area,
        responsible: form.responsible,
        cooling_system: form.coolingSystem,
        fire_suppression_system: form.fireSuppressionSystem,
        access_is_open: form.accessIsOpen,
        has_raised_floor: form.hasRaisedFloor,
        building_id: parseInt(this.$route.params.building_id),
      };
      const response = await postObject('room', formData);
      if (response.status === RESPONSE_STATUS.CREATED) {
        this.message.success = true;
        this.message.text = `Room ${response.data.data.name} added successfully`;
        // Reset form
        this.form.name = '';
        this.form.buildingFloor = '';
        this.form.description = '';
        this.form.numberOfRackSpaces = null;
        this.form.area = null;
        this.form.responsible = '';
        this.form.coolingSystem = 'Centralized';
        this.form.fireSuppressionSystem = 'Centralized';
        this.form.accessIsOpen = false;
        this.form.hasRaisedFloor = false;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

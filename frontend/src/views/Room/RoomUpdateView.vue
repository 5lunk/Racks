<template>
  <div class="min-h-full">
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
import { RESPONSE_STATUS } from '@/constants';
import {
  getObject,
  getResponseMessage,
  logIfNotStatus,
  putObject,
} from '@/api';

export default {
  name: 'RoomUpdateView',
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
  created() {
    this.setOldData();
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
      };
      const response = await putObject('room', this.$route.params.id, formData);
      if (response.status === RESPONSE_STATUS.ACCEPTED) {
        this.message.success = true;
        this.message.text = `Room ${response.data.data.name} updated successfully`;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    /**
     * Fetch and set room old data
     */
    async setOldData() {
      const response = await getObject('room', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      const room = response.data.data;
      this.form.name = room.name;
      this.form.buildingFloor = room.building_floor;
      this.form.description = room.description;
      this.form.numberOfRackSpaces = room.number_of_rack_spaces;
      this.form.area = room.area;
      this.form.responsible = room.responsible;
      this.form.coolingSystem = room.cooling_system;
      this.form.fireSuppressionSystem = room.fire_suppression_system;
      this.form.accessIsOpen = room.access_is_open;
      this.form.hasRaisedFloor = room.has_raised_floor;
    },
  },
};
</script>

<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div
        class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-light"
      >
        <TheMessage :message="message" />
      </div>
      <div :class="frameShadowStyle">
        Room №{{ room.id }}
        <router-link :to="{ path: `/room/${room.id}/update` }" target="_blank">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click.prevent="deleteRoom(room.id, room.name)"
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ location.regionName }} &#9002;
          {{ location.departmentName }} &#9002; {{ location.siteName }} &#9002;
          {{ location.buildingName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ room.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ room.updatedAt }}
          </text>
        </div>
      </div>
      <div class="text-sm">
        <div :class="frameShadowStyle">
          Room name:
          <text class="text-slate-500">
            {{ room.name }}
          </text>
          <br />
          Building floor:
          <text class="text-slate-500">
            {{ room.buildingFloor }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ room.description }}
          </text>
          <br />
          Number of rack spaces:
          <text class="text-slate-500">
            {{ room.numberOfRackSpaces }}
          </text>
          <br />
          Area (sq. m):
          <text class="text-slate-500">
            {{ room.area }}
          </text>
          <br />
          Responsible:
          <text class="text-slate-500">
            {{ room.responsible }}
          </text>
          <br />
          Cooling system:
          <text class="text-slate-500">
            {{ room.coolingSystem }}
          </text>
          <br />
          Fire suppression system:
          <text class="text-slate-500">
            {{ room.fireSuppressionSystem }}
          </text>
          <br />
          <template v-if="room.accessIsOpen">
            Active ventilation:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Active ventilation:
            <text class="text-slate-500"> No </text>
          </template>
          <br />
          <template v-if="room.hasRaisedFloor">
            Active ventilation:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Active ventilation:
            <text class="text-slate-500"> No </text>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TheMessage from '@/components/TheMessage.vue';
import { RESPONSE_STATUS } from '@/constants';
import {
  deleteObject,
  getObject,
  getObjectLocation,
  getResponseMessage,
  logIfNotStatus,
} from '@/api';
import {
  frameShadowStyle,
  optionButtonDarkStyle,
  optionButtonLightStyle,
} from '@/styleBindings';

export default {
  name: 'RoomView',
  components: {
    TheMessage,
  },
  data() {
    return {
      room: {
        id: this.$route.params.id,
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
        updatedBy: '',
        updatedAt: '',
      },
      message: {
        text: '',
        success: false,
      },
      location: {
        buildingName: '',
        siteName: '',
        departmentName: '',
        regionName: '',
      },
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.setRoom();
    this.setRoomLocation();
  },
  methods: {
    /**
     * Fetch and set room data
     */
    async setRoom() {
      const response = await getObject('room', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
      const room = response.data.data;
      this.room.name = room.name;
      this.room.buildingFloor = room.building_floor;
      this.room.description = room.description;
      this.room.numberOfRackSpaces = room.number_of_rack_spaces;
      this.room.area = room.area;
      this.room.responsible = room.responsible;
      this.room.coolingSystem = room.cooling_system;
      this.room.fireSuppressionSystem = room.fire_suppression_system;
      this.room.accessIsOpen = room.access_is_open;
      this.room.hasRaisedFloor = room.has_raised_floor;
      this.room.updatedBy = room.updated_by;
      this.room.updatedAt = room.updated_at;
      this.room.buildingId = room.building_id;
    },
    /**
     * Delete room
     * @param {Number} id Room id
     * @param {String} name Room name
     */
    async deleteRoom(id, name) {
      if (
        confirm(
          `Do you really want to delete room ${name} and all related items?`,
        )
      ) {
        const response = await deleteObject('room', this.$route.params.id);
        if (response.status === RESPONSE_STATUS.NO_CONTENT) {
          this.message.success = true;
          this.message.text = `Room ${id} deleted successfully`;
          alert(this.message.text);
          this.$router.push({ name: 'TreeView' });
        } else {
          this.message.success = false;
          this.message.text = getResponseMessage(response);
        }
      }
    },
    /**
     * Fetch and set room location
     */
    async setRoomLocation() {
      const response = await getObjectLocation('room', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      const location = response.data.data;
      this.location.buildingName = location.building_name;
      this.location.siteName = location.site_name;
      this.location.departmentName = location.department_name;
      this.location.regionName = location.region_name;
    },
  },
};
</script>

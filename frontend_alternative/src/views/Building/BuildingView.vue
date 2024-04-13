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
        Building №{{ building.id }}
        <router-link
          :to="{ path: `/building/${building.id}/update` }"
          target="_blank"
        >
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click.prevent="deleteBuilding(building.id, building.name)"
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ location.regionName }} &#9002;
          {{ location.departmentName }} &#9002;
          {{ location.siteName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ building.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ building.updatedAt }}
          </text>
        </div>
      </div>
      <div :class="frameShadowStyle">
        <div class="text-sm">
          Building name:
          <text class="text-slate-500">
            {{ building.name }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ building.description }}
          </text>
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
  name: 'BuildingView',
  components: {
    TheMessage,
  },
  data() {
    return {
      building: {
        id: this.$route.params.id,
        name: '',
        description: '',
        updatedBy: '',
        updatedAt: '',
      },
      message: {
        text: '',
        success: false,
      },
      location: {
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
    this.setBuilding();
    this.setBuildingLocation();
  },
  methods: {
    /**
     * Fetch and set building data
     */
    async setBuilding() {
      const response = await getObject('building', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
      const building = response.data.data;
      this.building.name = building.name;
      this.building.description = building.description;
      this.building.updatedBy = building.updated_by;
      this.building.updatedAt = building.updated_at;
      this.building.siteId = building.site_id;
    },
    /**
     * Delete building
     * @param {Number} id Building id
     * @param {String} name Building name
     */
    async deleteBuilding(id, name) {
      if (
        confirm(
          `Do you really want to delete building ${name} and all related items?`,
        )
      ) {
        const response = await deleteObject('building', this.$route.params.id);
        if (response.status === RESPONSE_STATUS.NO_CONTENT) {
          this.message.success = true;
          this.message.text = `Building ${id} deleted successfully`;
          alert(this.message.text);
          this.$router.push({ name: 'TreeView' });
        } else {
          this.message.success = false;
          this.message.text = getResponseMessage(response);
        }
      }
    },
    /**
     * Fetch and set building location
     */
    async setBuildingLocation() {
      const response = await getObjectLocation(
        'building',
        this.$route.params.id,
      );
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      const location = response.data.data;
      this.location.siteName = location.site_name;
      this.location.departmentName = location.department_name;
      this.location.regionName = location.region_name;
    },
  },
};
</script>

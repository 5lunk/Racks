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
        Site №{{ site.id }}
        <router-link :to="{ path: `/site/${site.id}/update` }" target="_blank">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click.prevent="deleteSite(site.id, site.name)"
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ location.regionName }} &#9002; {{ location.departmentName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ site.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ site.updatedAt }}
          </text>
        </div>
      </div>
      <div class="text-sm">
        <div :class="frameShadowStyle">
          Site name:
          <text class="text-slate-500">
            {{ site.name }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ site.description }}
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
  name: 'SiteView',
  components: {
    TheMessage,
  },
  data() {
    return {
      site: {
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
        departmentName: '',
        regionName: '',
      },
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.setSite();
    this.setSiteLocation();
  },
  methods: {
    /**
     * Fetch and set site data
     */
    async setSite() {
      const response = await getObject('site', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
      const site = response.data.data;
      this.site.name = site.name;
      this.site.description = site.description;
      this.site.updatedBy = site.updated_by;
      this.site.updatedAt = site.updated_at;
      this.site.siteId = site.site_id;
    },
    /**
     * Delete site
     * @param {Number} id Site id
     * @param {String} name Site name
     */
    async deleteSite(id, name) {
      if (
        confirm(
          `Do you really want to delete site ${name} and all related items?`,
        )
      ) {
        const response = await deleteObject('site', this.$route.params.id);
        if (response.status === RESPONSE_STATUS.NO_CONTENT) {
          this.message.success = true;
          this.message.text = `Site ${id} deleted successfully`;
          alert(this.message.text);
          this.$router.push({ name: 'TreeView' });
        } else {
          this.message.success = false;
          this.message.text = getResponseMessage(response);
        }
      }
    },
    /**
     * Fetch and set site location
     */
    async setSiteLocation() {
      const response = await getObjectLocation('site', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      const location = response.data.data;
      this.location.departmentName = location.department_name;
      this.location.regionName = location.region_name;
    },
  },
};
</script>

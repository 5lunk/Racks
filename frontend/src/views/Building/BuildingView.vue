<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Building №{{ building.id }}
        <router-link :to="{ path: `/building/${building.id}/update` }">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click.prevent="deleteBuilding"
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ buildingLocation.regionName }} &#9002;
          {{ buildingLocation.departmentName }} &#9002;
          {{ buildingLocation.siteName }}
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
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.$store.dispatch('getBuilding', parseInt(this.$route.params.id));
    this.$store.dispatch(
      'getBuildingLocation',
      parseInt(this.$route.params.id),
    );
  },
  computed: {
    building() {
      return this.$store.getters.building;
    },
    buildingLocation() {
      return this.$store.getters.buildingLocation;
    },
    message() {
      return this.$store.getters.message;
    },
    buildingDeleted() {
      return this.$store.getters.buildingDeleted;
    },
    noSuchBuilding() {
      return this.$store.getters.noSuchBuilding;
    },
  },
  watch: {
    buildingDeleted(deleted) {
      if (deleted) {
        alert(this.message.text);
        this.$router.push({ name: 'TreeView' });
      }
    },
    noSuchBuilding(notFound) {
      if (notFound) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
    },
  },
  methods: {
    deleteBuilding() {
      if (
        confirm(
          `Do you really want to delete building ${this.building.name} and all related items?`,
        )
      ) {
        this.$store.dispatch('deleteBuilding', this.building.id);
      }
    },
  },
};
</script>

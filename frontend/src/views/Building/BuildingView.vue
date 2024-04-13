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
          v-on:click.prevent="
            $store.dispatch('deleteBuilding', building.id, building.name)
          "
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
    this.$store.dispatch('getBuilding', this.$route.params.id);
    this.$store.dispatch('getBuildingLocation', this.$route.params.id);
  },
  computed: {
    building() {
      return this.$store.getters.building;
    },
    location() {
      return this.$store.getters.location;
    },
    message() {
      return this.$store.getters.message;
    },
  },
};
</script>

<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-light"
    >
      <TheMessage :message="siteMessage" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Site №{{ site.id }}
        <router-link :to="{ path: `/site/${site.id}/update` }">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button :class="optionButtonLightStyle" v-on:click.prevent="deleteSite">
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ siteLocation.regionName }} &#9002;
          {{ siteLocation.departmentName }}
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
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.$store.dispatch('getSite', this.$route.params.id);
    this.$store.dispatch('getSiteLocation', this.$route.params.id);
  },
  computed: {
    site() {
      return this.$store.getters.site;
    },
    siteLocation() {
      return this.$store.getters.siteLocation;
    },
    siteMessage() {
      return this.$store.getters.siteMessage;
    },
    siteDeleted() {
      return this.$store.getters.siteDeleted;
    },
    noSuchSite() {
      return this.$store.getters.noSuchSite;
    },
  },
  watch: {
    siteDeleted(deleted) {
      if (deleted) {
        alert(this.siteMessage.text);
        this.$router.push({ name: 'TreeView' });
      }
    },
    noSuchSite(notFound) {
      if (notFound) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
    },
  },
  methods: {
    deleteSite() {
      if (
        confirm(
          `Do you really want to delete site ${this.site.name} and all related items?`,
        )
      ) {
        this.$store.dispatch('deleteSite', this.site.id);
      }
    },
  },
};
</script>

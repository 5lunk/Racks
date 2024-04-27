<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Rack №{{ rack.id }}
        <router-link :to="{ path: `/rack/${rack.id}/update` }">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button :class="optionButtonLightStyle" v-on:click.prevent="deleteRack">
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ rackLocation.regionName }} &#9002;
          {{ rackLocation.departmentName }} &#9002;
          {{ rackLocation.siteName }} &#9002;
          {{ rackLocation.buildingName }} &#9002; {{ rackLocation.roomName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ rack.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ rack.updatedAt }}
          </text>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 text-sm">
        <div :class="frameShadowStyleFit">
          Rack name:
          <text class="text-slate-500">
            {{ rack.name }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ rack.description }}
          </text>
          <br />
          Responsible:
          <text class="text-slate-500">
            {{ rack.responsible }}
          </text>
          <br />
          Row:
          <text class="text-slate-500">
            {{ rack.row }}
          </text>
          <br />
          Place:
          <text class="text-slate-500">
            {{ rack.place }}
          </text>
          <br />
          Inventory number:
          <text class="text-slate-500">
            {{ rack.inventoryNumber }}
          </text>
          <br />
          Financially responsible:
          <text class="text-slate-500">
            {{ rack.financiallyResponsiblePerson }}
          </text>
          <br />
          Fixed asset:
          <text class="text-slate-500">
            {{ rack.fixedAsset }}
          </text>
          <br />
          <template v-if="rack.linkToDocs">
            Link to docs:
            <a class="text-slate-500" v-bind:href="rack.linkToDocs">
              <text class="text-blue-300"> &#9873; </text>
              {{ rack.linkToDocs }}
            </a>
          </template>
          <template v-else> Link to docs: </template>
        </div>
        <div :class="frameShadowStyleFit">
          Vendor:
          <text class="text-slate-500">
            {{ rack.vendor }}
          </text>
          <br />
          Model:
          <text class="text-slate-500">
            {{ rack.model }}
          </text>
          <br />
          Rack amount (units):
          <text class="text-slate-500">
            {{ rack.amount }}
          </text>
          <br />
          <template v-if="rack.hasNumberingFromTopToBottom">
            Numbering:
            <text class="text-slate-500"> from top to bottom </text>
          </template>
          <template v-else>
            Numbering:
            <text class="text-slate-500"> from bottom to top </text>
          </template>
          <br />
          <template v-if="rack.height">
            Rack height (mm):
            <text class="text-slate-500">
              {{ rack.height }}
            </text>
          </template>
          <template v-else> Rack height (mm): </template>
          <br />
          <template v-if="rack.width">
            Rack width (mm):
            <text class="text-slate-500">
              {{ rack.width }}
            </text>
          </template>
          <template v-else> Rack width (mm): </template>
          <br />
          <template v-if="rack.depth">
            Rack depth (mm):
            <text class="text-slate-500">
              {{ rack.depth }}
            </text>
          </template>
          <template v-else> Rack depth (mm): </template>
          <br />
          <template v-if="rack.unitWidth">
            Useful rack width (inches):
            <text class="text-slate-500">
              {{ rack.unitWidth }}
            </text>
          </template>
          <template v-else> Useful rack width (inches): </template>
          <br />
          <template v-if="rack.unitDepth">
            Useful rack depth (mm):
            <text class="text-slate-500">
              {{ rack.unitDepth }}
            </text>
          </template>
          <template v-else> Useful rack depth (mm): </template>
          <br />
          Execution variant:
          <text class="text-slate-500">
            {{ rack.type }}
          </text>
          <br />
          Construction:
          <text class="text-slate-500">
            {{ rack.frame }}
          </text>
          <br />
          Location type:
          <text class="text-slate-500">
            {{ rack.placeType }}
          </text>
          <br />
          <template v-if="rack.maxLoad">
            Max load (kilo):
            <text class="text-slate-500">
              {{ rack.maxLoad }}
            </text>
          </template>
          <template v-else> Max load (kilo): </template>
          <br />
          <template v-if="rack.powerSockets">
            Free power sockets:
            <text class="text-slate-500">
              {{ rack.powerSockets }}
            </text>
          </template>
          <template v-else> Free power sockets: </template>
          <br />
          <template v-if="rack.powerSocketsUps">
            Free UPS power sockets:
            <text class="text-slate-500">
              {{ rack.powerSocketsUps }}
            </text>
          </template>
          <template v-else> Free UPS power sockets: </template>
          <br />
          <template v-if="rack.hasCooler">
            Active ventilation:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Active ventilation:
            <text class="text-slate-500"> No </text>
          </template>
          <br />
          <template v-if="rack.hasExternalUps">
            External power backup supply system:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            External power backup supply system:
            <text class="text-slate-500"> No </text>
          </template>
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
  name: 'RackView',
  components: {
    TheMessage,
  },
  data() {
    return {
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
      frameShadowStyleFit: frameShadowStyle + ' h-fit',
    };
  },
  created() {
    this.$store.dispatch('getRack', parseInt(this.$route.params.id));
    this.$store.dispatch('getRackLocation', parseInt(this.$route.params.id));
  },
  computed: {
    rack() {
      return this.$store.getters.rack;
    },
    rackLocation() {
      return this.$store.getters.rackLocation;
    },
    message() {
      return this.$store.getters.message;
    },
    rackDeleted() {
      return this.$store.getters.rackDeleted;
    },
    noSuchRack() {
      return this.$store.getters.noSuchRack;
    },
  },
  watch: {
    rackDeleted(deleted) {
      if (deleted) {
        alert(this.message.text);
        this.$router.push({ name: 'TreeView' });
      }
    },
    noSuchRack(notFound) {
      if (notFound) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
    },
  },
  methods: {
    deleteRack() {
      if (
        confirm(
          `Do you really want to delete rack ${this.rack.name} and all related items?`,
        )
      ) {
        this.$store.dispatch('deleteRack', this.rack.id);
      }
    },
  },
};
</script>

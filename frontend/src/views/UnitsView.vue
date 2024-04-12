<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Rack №{{ rack.id }}
        <router-link
          :to="{ path: `/device/create/${this.$route.params.id}` }"
          target="_blank"
        >
          <button id="e2e_add_device" :class="optionButtonDarkStyle">
            Add device
          </button>
        </router-link>
        <router-link
          :to="{ path: `/rack/${this.$route.params.id}` }"
          target="_blank"
        >
          <button :class="optionButtonLightStyle">Info</button>
        </router-link>
        <div class="text-sm">
          Name:
          <text class="text-slate-500">
            {{ rack.name }}
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
        </div>
      </div>
      <div class="rack">
        <RackSideItem
          :side="`front side`"
          :devices="devicesFront"
          :firstUnits="firstUnitsFront"
          :rowSpans="rowSpansFront"
          :startList="startList"
        />
        <RackSideItem
          :side="`back side`"
          :devices="devicesBack"
          :firstUnits="firstUnitsBack"
          :rowSpans="rowSpansBack"
          :startList="startList"
        />
      </div>
    </div>
    <br />
  </div>
</template>

<script>
import RackSideItem from '@/components/Rack/RackSideItem.vue';
import { getObject, getObjectsForParent, logIfNotStatus } from '@/api';
import { RESPONSE_STATUS, UNITS_REFRESH_TIME } from '@/constants';
import {
  getDevicesForSide,
  getFirstUnits,
  getRowSpans,
  getStartList,
} from '@/functions';
import {
  frameShadowStyle,
  optionButtonDarkStyle,
  optionButtonLightStyle,
} from '@/styleBindings';

export default {
  name: 'UnitsView',
  components: {
    RackSideItem,
  },
  data() {
    return {
      objectExist: true,
      devices: [],
      rack: {},
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.setRack();
    this.setDevices();
    setInterval(() => {
      this.setDevices();
    }, UNITS_REFRESH_TIME);
  },
  computed: {
    /**
     * Devices front side
     */
    devicesFront() {
      return this.getDevicesForSide(this.devices).front;
    },
    /**
     * Devices back side
     */
    devicesBack() {
      return this.getDevicesForSide(this.devices).back;
    },
    /**
     * Devices first units front side
     */
    firstUnitsFront() {
      return this.getFirstUnits(
        this.devicesFront,
        this.rack.numbering_from_top_to_bottom,
      );
    },
    /**
     * Devices first units back side
     */
    firstUnitsBack() {
      return this.getFirstUnits(
        this.devicesBack,
        this.rack.numbering_from_top_to_bottom,
      );
    },
    /**
     * Rowspans front side
     */
    rowSpansFront() {
      return this.getRowSpans(this.devicesFront);
    },
    /**
     * Rowsspans back side
     */
    rowSpansBack() {
      return this.getRowSpans(this.devicesBack);
    },
    /**
     * Starting units list
     */
    startList() {
      return this.getStartList(this.rack);
    },
  },
  methods: {
    /**
     * Fetch and set rack data
     */
    async setRack() {
      const response = await getObject('rack', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      this.rack = response.data.data;
    },
    /**
     * Fetch and set devices data
     */
    async setDevices() {
      const response = await getObjectsForParent(
        'devices',
        'rack',
        this.$route.params.id,
      );
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      this.devices = response.data.data;
    },
    getRowSpans: getRowSpans,
    getFirstUnits: getFirstUnits,
    getStartList: getStartList,
    getDevicesForSide: getDevicesForSide,
  },
};
</script>

<style>
.rack {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}
@media screen and (max-width: 600px) {
  .rack {
    flex-direction: column;
    align-items: center;
  }
}
</style>

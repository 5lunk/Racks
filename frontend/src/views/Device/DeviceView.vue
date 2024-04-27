<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Device №{{ device.id }}
        <router-link :to="{ path: `/device/${device.id}/update` }">
          <button id="e2e_device_edit" :class="optionButtonDarkStyle">
            Edit
          </button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click.prevent="deleteDevice"
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ deviceLocation.regionName }} &#9002;
          {{ deviceLocation.departmentName }} &#9002;
          {{ deviceLocation.siteName }} &#9002;
          {{ deviceLocation.buildingName }} &#9002;
          {{ deviceLocation.roomName }} &#9002;
          {{ deviceLocation.rackName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ device.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ device.updatedAt }}
          </text>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 text-sm">
        <div :class="frameShadowStyleFit">
          Status:
          <text class="text-slate-500">
            {{ device.status }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ device.description }}
          </text>
          <br />
          <template v-if="device.hasBacksideLocation">
            Located on the back of the rack:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Located on the back of the rack:
            <text class="text-slate-500"> No </text>
          </template>
          <br />
          Installed in:
          <a class="text-slate-500" v-bind:href="`/rack/${device.rackId}`">
            <text class="text-blue-300"> &#9873; </text>
            Rack №{{ device.rackId }}
          </a>
          <br />
          Units:
          <text class="text-slate-500">
            {{ device.units.toString() }}
          </text>
          <br />
          Ownership:
          <text class="text-slate-500">
            {{ device.ownership }}
          </text>
          <br />
          Responsible:
          <text class="text-slate-500">
            {{ device.responsible }}
          </text>
          <br />
          Project:
          <text class="text-slate-500">
            {{ device.project }}
          </text>
          <br />
          Inventory number:
          <text class="text-slate-500">
            {{ device.inventoryNumber }}
          </text>
          <br />
          Financially responsible:
          <text class="text-slate-500">
            {{ device.financiallyResponsiblePerson }}
          </text>
          <br />
          Fixed asset:
          <text class="text-slate-500">
            {{ device.fixedAsset }}
          </text>
          <br />
          <template v-if="device.link">
            Link to docs:
            <a class="text-slate-500" v-bind:href="device.linkToDocs">
              <text class="text-blue-300"> &#9873; </text>
              {{ device.linkToDocs }}
            </a>
          </template>
          <template v-else> Link to docs: </template>
          <br />
        </div>
        <div :class="frameShadowStyleFit">
          Vendor:
          <text class="text-slate-500">
            {{ device.vendor }}
          </text>
          <br />
          Model:
          <text class="text-slate-500">
            {{ device.model }}
          </text>
          <br />
          Device type:
          <text class="text-slate-500">
            {{ device.type }}
          </text>
          <br />
          <template v-if="devicesWithOS.includes(device.type)">
            Hostname:
            <text class="text-slate-500">
              {{ device.hostname }}
            </text>
            <br />
            <template v-if="device.ip">
              IP-address:
              <text class="text-slate-500">
                {{ device.ip }}
              </text>
            </template>
            <template v-else> IP-address: </template>
            <br />
            <template v-if="device.stack">
              Stack/Reserve (reserve ID):
              <a class="text-slate-500" v-bind:href="`/device/${device.stack}`">
                <text class="text-blue-300"> &#9873; </text>
                Device №{{ device.stack }}
              </a>
            </template>
            <template v-else> Stack/Reserve (reserve ID): </template>
            <br />
            <template v-if="device.softwareVersion">
              Software version:
              <text class="text-slate-500">
                {{ device.softwareVersion }}
              </text>
            </template>
            <template v-else> Software version: </template>
            <br />
          </template>
          <template v-if="devicesWithPorts.includes(device.type)">
            <template v-if="device.portsAmount">
              Port capacity:
              <text class="text-slate-500">
                {{ device.portsAmount }}
              </text>
            </template>
            <template v-else> Port capacity: </template>
            <br />
          </template>
          Serial number:
          <text class="text-slate-500">
            {{ device.serialNumber }}
          </text>
          <br />
          Socket type:
          <text class="text-slate-500">
            {{ device.powerType }}
          </text>
          <br />
          <template v-if="device.powerW">
            Power requirement (W):
            <text class="text-slate-500">
              {{ device.powerW }}
            </text>
          </template>
          <template v-else> Power requirement (W): </template>
          <br />
          <template v-if="device.powerV">
            Voltage (V):
            <text class="text-slate-500">
              {{ device.powerV }}
            </text>
          </template>
          <template v-else> Voltage (V): </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TheMessage from '@/components/TheMessage.vue';
import { DEVICES_WITH_OS, DEVICES_WITH_PORTS } from '@/constants';
import {
  frameShadowStyle,
  optionButtonDarkStyle,
  optionButtonLightStyle,
} from '@/styleBindings';

export default {
  name: 'DeviceView',
  components: {
    TheMessage,
  },
  data() {
    return {
      devicesWithPorts: DEVICES_WITH_PORTS,
      devicesWithOS: DEVICES_WITH_OS,
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
      frameShadowStyleFit: frameShadowStyle + ' h-fit',
    };
  },
  created() {
    this.$store.dispatch('getDevice', parseInt(this.$route.params.id));
    this.$store.dispatch('getDeviceLocation', parseInt(this.$route.params.id));
  },
  computed: {
    device() {
      return this.$store.getters.device;
    },
    deviceLocation() {
      return this.$store.getters.deviceLocation;
    },
    message() {
      return this.$store.getters.message;
    },
    noSuchDevice() {
      return this.$store.getters.noSuchDevice;
    },
    deviceDeleted() {
      return this.$store.getters.deviceDeleted;
    },
  },
  watch: {
    deviceDeleted(deleted) {
      if (deleted) {
        alert(this.message.text);
        this.$router.push({
          name: 'UnitsView',
          params: { id: this.device.rackId },
        });
      }
    },
    noSuchDevice(notFound) {
      if (notFound) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
    },
  },
  methods: {
    deleteDevice() {
      if (
        confirm(
          `Do you really want to delete device ${this.device.vendor} ${this.device.model} and all related items?`,
        )
      ) {
        this.$store.dispatch('deleteDevice', this.device.id);
      }
    },
  },
};
</script>

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
        Device №{{ device.id }}
        <router-link
          :to="{ path: `/device/${device.id}/update` }"
          target="_blank"
        >
          <button id="e2e_device_edit" :class="optionButtonDarkStyle">
            Edit
          </button>
        </router-link>
        <button
          :class="optionButtonLightStyle"
          v-on:click="
            deleteDevice(device.id, `${device.vendor} ${device.model}`)
          "
        >
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ location.regionName }} &#9002;
          {{ location.departmentName }} &#9002; {{ location.siteName }} &#9002;
          {{ location.buildingName }} &#9002; {{ location.roomName }} &#9002;
          {{ location.rackName }}
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
          <a
            class="text-slate-500"
            v-bind:href="`/rack/${device.rackId}`"
            target="_blank"
          >
            <text class="text-blue-300"> &#9873; </text>
            Rack №{{ device.rackId }}
          </a>
          <br />
          Units:
          <text class="text-slate-500">
            {{ device.units }}
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
              <a
                class="text-slate-500"
                v-bind:href="`/device/${device.stack}`"
                target="_blank"
              >
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
import {
  deleteObject,
  getObject,
  getObjectLocation,
  getResponseMessage,
  logIfNotStatus,
} from '@/api';
import {
  DEVICES_WITH_OS,
  DEVICES_WITH_PORTS,
  RESPONSE_STATUS,
} from '@/constants';
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
      device: {
        id: this.$route.params.id,
        units: '',
        hasBacksideLocation: false,
        status: 'Device active',
        type: 'Other',
        vendor: '',
        model: '',
        hostname: '',
        ip: null,
        stack: null,
        portsAmount: null,
        softwareVersion: '',
        powerType: 'IEC C14 socket',
        powerW: null,
        powerV: null,
        powerACDC: 'AC',
        serialNumber: '',
        description: '',
        project: '',
        ownership: 'Our department',
        responsible: '',
        financiallyResponsiblePerson: '',
        inventoryNumber: '',
        fixedAsset: '',
        link: '',
        updatedBy: '',
        updatedAt: '',
        rackId: '',
      },
      message: {
        text: '',
        success: false,
      },
      location: {
        rackName: '',
        roomName: '',
        buildingName: '',
        siteName: '',
        departmentName: '',
        regionName: '',
      },
      devicesWithPorts: DEVICES_WITH_PORTS,
      devicesWithOS: DEVICES_WITH_OS,
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
      frameShadowStyleFit: frameShadowStyle + ' h-fit',
    };
  },
  created() {
    this.setDevice();
    this.setDeviceLocation();
  },
  methods: {
    /**
     * Fetch and set device data
     */
    async setDevice() {
      const response = await getObject('device', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      const device = response.data.data;
      this.device.units = device.units.toString();
      this.device.hasBacksideLocation = device.has_backside_location;
      this.device.status = device.status;
      this.device.type = device.type;
      this.device.vendor = device.vendor;
      this.device.model = device.model;
      this.device.hostname = device.hostname;
      this.device.ip = device.ip;
      this.device.stack = device.stack;
      this.device.portsAmount = device.ports_amount;
      this.device.softwareVersion = device.software_version;
      this.device.powerType = device.power_type;
      this.device.powerW = device.power_w;
      this.device.powerV = device.power_v;
      this.device.powerACDC = device.power_ac_dc;
      this.device.serialNumber = device.serial_number;
      this.device.description = device.description;
      this.device.project = device.project;
      this.device.ownership = device.ownership;
      this.device.responsible = device.responsible;
      this.device.financiallyResponsiblePerson =
        device.financially_responsible_person;
      this.device.inventoryNumber = device.inventory_number;
      this.device.fixedAsset = device.fixed_asset;
      this.device.linkToDocs = device.link_to_docs;
      this.device.updatedBy = device.updated_by;
      this.device.updatedAt = device.updated_at;
      this.device.rackId = device.rack_id;
    },
    /**
     * Delete device
     * @param {Number} id Device id
     * @param {String} name Device name
     */
    async deleteDevice(id, name) {
      if (confirm(`Do you really want to delete device ${name}?`)) {
        const response = await deleteObject('device', this.$route.params.id);
        if (response.status === RESPONSE_STATUS.NO_CONTENT) {
          this.message.success = true;
          this.message.text = `Device ${id} deleted successfully`;
          alert(this.message.text);
          this.$router.push('/units/' + this.device.rackId);
        } else {
          this.message.success = false;
          this.message.text = getResponseMessage(response);
        }
      }
    },
    /**
     * Fetch and set device location
     */
    async setDeviceLocation() {
      const response = await getObjectLocation('device', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      const location = response.data.data;
      this.location.rackName = location.rack_name;
      this.location.roomName = location.room_name;
      this.location.buildingName = location.building_name;
      this.location.siteName = location.site_name;
      this.location.departmentName = location.department_name;
      this.location.regionName = location.region_name;
    },
  },
};
</script>

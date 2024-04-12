<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="message" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-sm font-light"
    >
      <DeviceForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import DeviceForm from '@/components/DeviceForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import {
  getObject,
  getResponseMessage,
  logIfNotStatus,
  putObject,
} from '@/api';
import { getUnitsArray } from '@/functions';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'DeviceUpdateView',
  components: {
    DeviceForm,
    TheMessage,
  },
  data() {
    return {
      form: {
        firstUnit: null,
        lastUnit: null,
        hasBacksideLocation: false,
        status: 'Device active',
        deviceType: 'Other',
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
        ownership: '',
        responsible: '',
        financiallyResponsiblePerson: '',
        inventoryNumber: '',
        fixedAsset: '',
      },
      message: {
        text: '',
        success: false,
      },
    };
  },
  created() {
    this.setOldData();
  },
  methods: {
    /**
     * Submit device form
     * @param {Object} form Device form
     */
    async submitForm(form) {
      // If form not valid
      if (form.$errors) {
        this.message.text = '';
        this.message.success = false;
        return;
      }
      // If form valid
      const firstUnit = parseInt(form.firstUnit);
      const lastUnit = parseInt(form.lastUnit);
      const formData = {
        units: getUnitsArray(firstUnit, lastUnit),
        has_backside_location: form.hasBacksideLocation,
        status: form.status,
        type: form.deviceType,
        vendor: form.vendor,
        model: form.model,
        hostname: form.hostname,
        ip: form.ip,
        stack: form.stack,
        ports_amount: form.portsAmount,
        software_version: form.softwareVersion,
        power_type: form.powerType,
        power_w: form.powerW,
        power_v: form.powerV,
        power_ac_dc: form.powerACDC,
        serial_number: form.serialNumber,
        description: form.description,
        project: form.project,
        ownership: form.ownership,
        responsible: form.responsible,
        financially_responsible_person: form.financiallyResponsiblePerson,
        inventory_number: form.inventoryNumber,
        fixed_asset: form.fixedAsset,
      };
      const response = await putObject(
        'device',
        this.$route.params.id,
        formData,
      );
      if (response.status === RESPONSE_STATUS.ACCEPTED) {
        this.message.success = true;
        this.message.text = `Device ${response.data.data.vendor || 'undefined vendor'}
          ${response.data.data.model || 'undefined model'} updated successfully`;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    /**
     * Fetch and set device old data
     */
    async setOldData() {
      const response = await getObject('device', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      const device = response.data.data;
      this.form.firstUnit = device.units[0];
      this.form.lastUnit = device.units[device.units.length - 1];
      this.form.hasBacksideLocation = device.has_backside_location;
      this.form.status = device.status;
      this.form.deviceType = device.type;
      this.form.vendor = device.vendor;
      this.form.model = device.model;
      this.form.hostname = device.hostname;
      this.form.ip = device.ip;
      this.form.stack = device.stack;
      this.form.portsAmount = device.ports_amount;
      this.form.softwareVersion = device.software_version;
      this.form.powerType = device.power_type;
      this.form.powerW = device.power_w;
      this.form.powerV = device.power_v;
      this.form.powerACDC = device.power_ac_dc;
      this.form.serialNumber = device.serial_number;
      this.form.description = device.description;
      this.form.project = device.project;
      this.form.ownership = device.ownership;
      this.form.responsible = device.responsible;
      this.form.financiallyResponsiblePerson =
        device.financially_responsible_person;
      this.form.inventoryNumber = device.inventory_number;
      this.form.fixedAsset = device.fixed_asset;
    },
  },
};
</script>

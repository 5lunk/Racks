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
import DeviceForm from '@/components/Device/DeviceForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import { getResponseMessage, postObject } from '@/api';
import { getUnitsArray } from '@/functions';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'DeviceAddView',
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
        linkToDocs: '',
        project: '',
        ownership: 'Our department',
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
        link_to_docs: form.linkToDocs,
        project: form.project,
        ownership: form.ownership,
        responsible: form.responsible,
        financially_responsible_person: form.financiallyResponsiblePerson,
        inventory_number: form.inventoryNumber,
        fixed_asset: form.fixedAsset,
        rack_id: parseInt(this.$route.params.rack_id),
      };
      const response = await postObject('device', formData);
      if (response.status === RESPONSE_STATUS.CREATED) {
        this.message.success = true;
        this.message.text = `Device ${response.data.data.vendor || 'undefined vendor'}
          ${response.data.data.model || 'undefined model'} added successfully`;
        // Reset form
        this.form.firstUnit = null;
        this.form.lastUnit = null;
        this.form.hasBacksideLocation = false;
        this.form.status = 'Device active';
        this.form.deviceType = 'Other';
        this.form.vendor = '';
        this.form.model = '';
        this.form.hostname = '';
        this.form.ip = null;
        this.form.stack = null;
        this.form.portsAmount = null;
        this.form.softwareVersion = '';
        this.form.powerType = 'IEC C14 socket';
        this.form.powerW = null;
        this.form.powerV = null;
        this.form.powerACDC = 'AC';
        this.form.serialNumber = '';
        this.form.description = '';
        this.form.linkToDocs = '';
        this.form.project = '';
        this.form.ownership = 'Our department';
        this.form.responsible = '';
        this.form.financiallyResponsiblePerson = '';
        this.form.inventoryNumber = '';
        this.form.fixedAsset = '';
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

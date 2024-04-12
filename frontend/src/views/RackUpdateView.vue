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
      <RackForm :form="form" :update="update" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import RackForm from '@/components/RackForm.vue';
import TheMessage from '@/components/TheMessage.vue';
import { RESPONSE_STATUS } from '@/constants';
import {
  getObject,
  getResponseMessage,
  logIfNotStatus,
  putObject,
} from '@/api';

export default {
  name: 'RackUpdateView',
  components: {
    RackForm,
    TheMessage,
  },
  data() {
    return {
      form: {
        name: '',
        amount: null,
        vendor: '',
        model: '',
        description: '',
        hasNumberingFromTopToBottom: false,
        responsible: '',
        financiallyResponsiblePerson: '',
        inventoryNumber: '',
        fixedAsset: '',
        linkToDocs: '',
        row: '',
        place: '',
        height: null,
        width: null,
        depth: null,
        unitWidth: null,
        unitDepth: null,
        executionType: 'Rack',
        frame: 'Double frame',
        placeType: 'Floor standing',
        maxLoad: null,
        powerSockets: null,
        powerSocketsUps: null,
        hasExternalUps: false,
        hasCooler: false,
      },
      update: true,
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
     * Submit rack form
     * @param {Object} form Rack form
     */
    async submitForm(form) {
      // If form not valid
      if (form.$errors) {
        this.message.text = '';
        this.message.success = false;
        return;
      }
      // If form valid
      // Amount update not allowed
      const formData = {
        name: form.name,
        vendor: form.vendor,
        model: form.model,
        description: form.description,
        has_numbering_from_bottom_to_top: form.hasNumberingFromBottomToTop,
        responsible: form.responsible,
        financially_responsible_person: form.financiallyResponsiblePerson,
        inventory_number: form.inventoryNumber,
        fixed_asset: form.fixedAsset,
        link: form.link,
        row: form.row,
        place: form.place,
        height: form.height,
        width: form.width,
        depth: form.depth,
        unit_width: form.unitWidth,
        unit_depth: form.unitDepth,
        type: form.executionType,
        frame: form.frame,
        place_type: form.placeType,
        max_load: form.maxLoad,
        power_sockets: form.powerSockets,
        power_sockets_ups: form.powerSocketsUps,
        has_external_ups: form.hasExternalUps,
        has_cooler: form.hasCooler,
      };
      const response = await putObject('rack', this.$route.params.id, formData);
      if (response.status === RESPONSE_STATUS.ACCEPTED) {
        this.message.success = true;
        this.message.text = `Rack ${response.data.data.name} updated successfully`;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    /**
     * Fetch and set rack old data
     */
    async setOldData() {
      const response = await getObject('rack', this.$route.params.id);
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      if (response.status === RESPONSE_STATUS.NOT_FOUND) {
        this.$router.push('/404');
      }
      const rack = response.data.data;
      this.form.name = rack.name;
      this.form.amount = rack.amount;
      this.form.vendor = rack.vendor;
      this.form.model = rack.model;
      this.form.description = rack.description;
      this.form.hasNumberingFromTopToBottom =
        rack.has_numbering_from_top_to_bottom;
      this.form.responsible = rack.responsible;
      this.form.financiallyResponsiblePerson =
        rack.financially_responsible_person;
      this.form.inventoryNumber = rack.inventory_number;
      this.form.fixedAsset = rack.fixed_asset;
      this.form.linkToDocs = rack.link_to_docs;
      this.form.row = rack.row;
      this.form.place = rack.place;
      this.form.height = rack.height;
      this.form.width = rack.width;
      this.form.depth = rack.depth;
      this.form.unitWidth = rack.unit_width;
      this.form.unitDepth = rack.unit_depth;
      this.form.executionType = rack.type;
      this.form.frame = rack.frame;
      this.form.placeType = rack.place_type;
      this.form.maxLoad = rack.max_load;
      this.form.powerSockets = rack.power_sockets;
      this.form.powerSocketsUps = rack.power_sockets_ups;
      this.form.hasExternalUps = rack.has_external_ups;
      this.form.hasCooler = rack.has_cooler;
    },
  },
};
</script>

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
import { getResponseMessage, postObject } from '@/api';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'RackAddView',
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
        link: '',
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
      update: false,
      message: {
        text: '',
        success: false,
      },
    };
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
      const formData = {
        name: form.name,
        amount: parseInt(form.amount),
        vendor: form.vendor,
        model: form.model,
        description: form.description,
        has_numbering_from_top_to_bottom: form.hasNumberingFromTopToBottom,
        responsible: form.responsible,
        financially_responsible_person: form.financiallyResponsiblePerson,
        inventory_number: form.inventoryNumber,
        fixed_asset: form.fixedAsset,
        link_to_docs: form.linkToDocs,
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
        room_id: parseInt(this.$route.params.room_id),
      };
      const response = await postObject('rack', formData);
      if (response.status === RESPONSE_STATUS.CREATED) {
        this.message.success = true;
        this.message.text = `Rack ${response.data.data.name} added successfully`;
        // Reset form
        this.form.name = '';
        this.form.amount = null;
        this.form.vendor = '';
        this.form.model = '';
        this.form.description = '';
        this.form.hasNumberingFromTopToBottom = false;
        this.form.responsible = '';
        this.form.financiallyResponsiblePerson = '';
        this.form.inventoryNumber = '';
        this.form.fixedAsset = '';
        this.form.link = '';
        this.form.row = '';
        this.form.place = '';
        this.form.height = null;
        this.form.width = null;
        this.form.depth = null;
        this.form.unitWidth = null;
        this.form.unitDepth = null;
        this.form.executionType = 'Rack';
        this.form.frame = 'Double frame';
        this.form.placeType = 'Floor standing';
        this.form.maxLoad = null;
        this.form.powerSockets = null;
        this.form.powerSocketsUps = null;
        this.form.hasExternalUps = false;
        this.form.hasCooler = false;
      } else {
        this.message.success = false;
        this.message.text = getResponseMessage(response);
      }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

<template>
  <div :class="frameShadowStyle">
    <form v-on:submit.prevent="emitData" class="text-sm">
      <label for="name"> Rack name: </label>
      <input
        id="e2e_rack_name"
        :class="formInputStyle"
        placeholder="Enter rack name here"
        name="name"
        type="text"
        v-model="form.name"
      />
      <p v-for="error of v$.form.name.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ error.$message }}
        </text>
      </p>
      <br />
      <template v-if="!update">
        <label for="amount"> Rack amount (units): </label>
        <input
          id="e2e_rack_amount"
          :class="formInputStyle"
          placeholder="Filled in once (cannot be changed later)"
          name="amount"
          type="text"
          v-model="form.amount"
        />
        <p v-for="error of v$.form.amount.$errors" :key="error.$uid">
          <text class="text-red-500">
            {{ error.$message }}
          </text>
        </p>
        <br />
      </template>
      <template v-if="rackModels.itemType">
        <ChooseExistingItem
          :itemsData="rackModels"
          :isHidden="modelsIsHidden"
          v-model:modelValue="form.model"
        />
      </template>
      <template v-else>
        Please wait...
        <br />
        <br />
      </template>
      <template v-if="rackVendors.itemType">
        <ChooseExistingItem
          :itemsData="rackVendors"
          :isHidden="vendorsIsHidden"
          v-model:modelValue="form.vendor"
        />
      </template>
      <template v-else>
        Please wait...
        <br />
        <br />
      </template>
      <label for="description"> Description: </label>
      <input
        :class="formInputStyle"
        placeholder="Can be used for notes"
        name="description"
        type="text"
        v-model="form.description"
      />
      <br />
      <input
        :class="formCheckboxStyle"
        name="hasNumberingFromTopToBottom"
        type="checkbox"
        v-model="form.hasNumberingFromTopToBottom"
      />
      <label for="hasNumberingFromTopToBottom" class="px-2">
        Numbering from top to bottom
      </label>
      <br />
      <br />
      <label for="responsible"> Responsible: </label>
      <input
        :class="formInputStyle"
        name="responsible"
        type="text"
        v-model="form.responsible"
      />
      <br />
      <label for="financiallyResponsiblePerson">
        Financially responsible:
      </label>
      <input
        :class="formInputStyle"
        name="financiallyResponsiblePerson"
        type="text"
        v-model="form.financiallyResponsiblePerson"
      />
      <br />
      <label for="inventoryNumber"> Inventory number: </label>
      <input
        :class="formInputStyle"
        name="inventoryNumber"
        type="text"
        v-model="form.inventoryNumber"
      />
      <br />
      <label for="fixedAsset"> Fixed asset: </label>
      <input
        :class="formInputStyle"
        name="fixedAsset"
        type="text"
        v-model="form.fixedAsset"
      />
      <br />
      <label for="link"> Link to docs: </label>
      <input
        :class="formInputStyle"
        placeholder="Link to some documentation"
        name="link"
        type="text"
        v-model="form.linkToDocs"
      />
      <br />
      <label for="row"> Row: </label>
      <input
        :class="formInputStyle"
        name="row"
        type="text"
        v-model="form.row"
      />
      <br />
      <label for="place"> Place: </label>
      <input
        :class="formInputStyle"
        name="place"
        type="text"
        v-model="form.place"
      />
      <br />
      <label for="height"> Rack height (mm): </label>
      <input
        :class="formInputStyle"
        name="height"
        type="text"
        v-model="form.height"
      />
      <p v-for="error of v$.form.height.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="width"> Rack width (mm): </label>
      <input
        :class="formInputStyle"
        name="width"
        type="text"
        v-model="form.width"
      />
      <p v-for="error of v$.form.width.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="depth"> Rack depth (mm): </label>
      <input
        :class="formInputStyle"
        name="depth"
        type="text"
        v-model="form.depth"
      />
      <p v-for="error of v$.form.depth.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="unitWidth"> Useful rack width (inches): </label>
      <input
        :class="formInputStyle"
        placeholder="Frame width"
        name="unitWidth"
        type="text"
        v-model="form.unitWidth"
      />
      <p v-for="error of v$.form.unitWidth.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="unitDepth"> Useful rack depth (mm): </label>
      <input
        :class="formInputStyle"
        placeholder="Depth from frame to frame"
        name="unitDepth"
        type="text"
        v-model="form.unitDepth"
      />
      <p v-for="error of v$.form.unitDepth.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="type"> Execution variant: </label>
      <select :class="formInputStyle" v-model="form.executionType">
        <option value="Rack" selected="selected">Rack</option>
        <option value="Protective cabinet">Protective cabinet</option>
      </select>
      <br />
      <label for="frame"> Construction: </label>
      <select :class="formInputStyle" v-model="form.frame">
        <option value="Double frame" selected="selected">Double frame</option>
        <option value="Single frame">Single frame</option>
      </select>
      <br />
      <label for="placeType"> Location type: </label>
      <select :class="formInputStyle" v-model="form.placeType">
        <option value="Floor standing" selected="selected">
          Floor standing
        </option>
        <option value="Wall mounted">Wall mounted</option>
      </select>
      <br />
      <label for="maxLoad"> Max load (kilo): </label>
      <input
        :class="formInputStyle"
        name="maxLoad"
        type="text"
        v-model="form.maxLoad"
      />
      <p v-for="error of v$.form.maxLoad.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="powerSockets"> Free power sockets: </label>
      <input
        :class="formInputStyle"
        name="powerSockets"
        type="text"
        v-model="form.powerSockets"
      />
      <p v-for="error of v$.form.powerSockets.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="powerSocketsUps"> Free UPS power sockets: </label>
      <input
        :class="formInputStyle"
        name="powerSocketsUps"
        type="text"
        v-model="form.powerSocketsUps"
      />
      <p v-for="error of v$.form.powerSocketsUps.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <input
        :class="formCheckboxStyle"
        name="hasExternalUps"
        type="checkbox"
        v-model="form.hasExternalUps"
      />
      <label for="hasExternalUps" class="px-2">
        External power backup supply system
      </label>
      <br />
      <br />
      <input
        :class="formCheckboxStyle"
        name="hasCooler"
        type="checkbox"
        v-model="form.hasCooler"
      />
      <label for="hasCooler" class="px-2"> Active ventilation </label>
      <br />
      <br />
      <button
        :class="formSubmitButtonStyle"
        type="submit"
        id="e2e_submit_button"
        v-on:click="submit"
      >
        Submit data
      </button>
    </form>
  </div>
  <br />
</template>

<script>
import ChooseExistingItem from '../ChooseExistingItem.vue';
import useVuelidate from '@vuelidate/core';
import { minValue, numeric, required } from '@vuelidate/validators';
import { numericGTZOrNull, numericOrNull } from '@/validators';
import { setEmptyStringToNull } from '@/functions';
import {
  formCheckboxStyle,
  formInputStyle,
  formSubmitButtonStyle,
  frameShadowStyle,
} from '@/styleBindings';

export default {
  name: 'RackForm',
  components: {
    ChooseExistingItem,
  },
  props: {
    form: {
      name: String,
      amount: Number | null,
      vendor: String,
      model: String,
      description: String,
      hasNumberingFromTopToBottom: Boolean,
      responsible: String,
      financiallyResponsiblePerson: String,
      inventoryNumber: String,
      fixedAsset: String,
      linkToDocs: String,
      row: String,
      place: String,
      height: Number | null,
      width: Number | null,
      depth: Number | null,
      unitWidth: Number | null,
      unitDepth: Number | null,
      executionType: String,
      frame: String,
      placeType: String,
      maxLoad: Number | null,
      powerSockets: Number | null,
      powerSocketsUps: Number | null,
      hasExternalUps: Boolean,
      hasCooler: Boolean,
    },
    update: Boolean,
  },
  emits: ['onSubmit'],
  data() {
    return {
      v$: useVuelidate(),
      vendorsIsHidden: true,
      modelsIsHidden: true,
      numericOrNullValidationError:
        'Value must be an integer and greater than zero',
      formInputStyle: formInputStyle,
      formSubmitButtonStyle: formSubmitButtonStyle,
      frameShadowStyle: frameShadowStyle,
      formCheckboxStyle: formCheckboxStyle,
    };
  },
  created() {
    this.$store.dispatch('getRackVendors');
    this.$store.dispatch('getRackModels');
  },
  validations() {
    return {
      form: {
        name: { required },
        amount: { required, numeric, minValue: minValue(1) },
        hasNumberingFromTopToBottom: { required },
        height: { numericGTZOrNull },
        width: { numericGTZOrNull },
        depth: { numericGTZOrNull },
        unitWidth: { numericGTZOrNull },
        unitDepth: { numericGTZOrNull },
        maxLoad: { numericGTZOrNull },
        powerSockets: { numericOrNull },
        powerSocketsUps: { numericOrNull },
      },
    };
  },
  computed: {
    rackVendors() {
      return this.$store.getters.rackVendors;
    },
    rackModels() {
      return this.$store.getters.rackModels;
    },
  },
  methods: {
    /**
     * Submit
     */
    submit() {
      this.v$.$touch();
    },
    emitData() {
      if (this.v$.$errors.length) {
        confirm('Form not valid, please check the fields');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        this.$emit('onSubmit', this.v$);
      } else {
        // Yes, this is a crutch, but quite simple and understandable
        const fieldNamesArr = [
          'height',
          'width',
          'depth',
          'unitWidth',
          'unitDepth',
          'maxLoad',
          'powerSockets',
          'powerSocketsUps',
        ];
        this.setEmptyStringToNull(fieldNamesArr, this.form);
        this.v$.$reset();
        this.$emit('onSubmit', this.form);
      }
    },
    setEmptyStringToNull: setEmptyStringToNull,
  },
};
</script>

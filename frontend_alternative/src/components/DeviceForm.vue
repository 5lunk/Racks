<template>
  <div
    class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
  >
    <div :class="frameShadowStyle">
      <form v-on:submit.prevent="emitData" class="text-sm">
        <label for="firstUnit"> First unit: </label>
        <input
          id="e2e_first_unit"
          :class="formInputStyle"
          placeholder="Order doesn't matter"
          name="firstUnit"
          type="text"
          v-model="form.firstUnit"
        />
        <p v-for="error of v$.form.firstUnit.$errors" :key="error.$uid">
          <text class="text-red-500">
            {{ error.$message }}
          </text>
        </p>
        <br />
        <label for="lastUnit">Last unit: </label>
        <input
          id="e2e_last_unit"
          :class="formInputStyle"
          placeholder="Order doesn't matter"
          name="lastUnit"
          type="text"
          v-model="form.lastUnit"
        />
        <p v-for="error of v$.form.lastUnit.$errors" :key="error.$uid">
          <text class="text-red-500">
            {{ error.$message }}
          </text>
        </p>
        <br />
        <input
          :class="formCheckboxStyle"
          name="hasBacksideLocation"
          type="checkbox"
          v-model="form.hasBacksideLocation"
        />
        <label for="hasBacksideLocation" class="px-2">
          Installed on the back
        </label>
        <br />
        <br />
        <label for="status"> Status: </label>
        <select :class="formInputStyle" v-model="form.status">
          <option value="Device active" selected="selected">
            Device active
          </option>
          <option value="Device failed">Device failed</option>
          <option value="Device turned off">Device turned off</option>
          <option value="Device not in use">Device not in use</option>
          <option value="Units reserved">Units reserved</option>
          <option value="Units not available">Units not available</option>
        </select>
        <br />
        <label for="status"> Device type: </label>
        <select :class="formInputStyle" v-model="form.deviceType">
          <option value="Other" selected="selected">Other</option>
          <option value="Switch">Switch</option>
          <option value="Router">Router</option>
          <option value="Firewall">Firewall</option>
          <option value="Security Gateway">Security Gateway</option>
          <option value="Fiber optic patch panel">
            Fiber optic patch panel
          </option>
          <option value="RJ45 patch panel">RJ45 patch panel</option>
          <option value="Organizer">Organizer</option>
          <option value="Rack shelf">Rack shelf</option>
          <option value="UPS">UPS</option>
          <option value="Server">Server</option>
          <option value="KVM console">KVM console</option>
        </select>
        <br />
        <template v-if="models.item_type">
          <ChooseExistingItem
            :itemsData="models"
            :isHidden="modelsIsHidden"
            v-model:modelValue="form.model"
          />
        </template>
        <template v-else>
          <br />
          Please wait...
          <br />
        </template>
        <template v-if="vendors.item_type">
          <ChooseExistingItem
            :itemsData="vendors"
            :isHidden="vendorsIsHidden"
            v-model:modelValue="form.vendor"
          />
        </template>
        <template v-else>
          <br />
          Please wait...
          <br />
        </template>
        <template v-if="devicesWithOS.includes(form.deviceType)">
          <label for="hostname"> Hostname: </label>
          <input
            :class="formInputStyle"
            name="hostname"
            type="text"
            v-model="form.hostname"
          /><br />
          <label for="ip"> IP-address: </label>
          <input
            :class="formInputStyle"
            name="ip"
            type="text"
            v-model="form.ip"
          />
          <p v-for="error of v$.form.ip.$errors" :key="error.$uid">
            <text class="text-red-500">
              {{ error.$message }}
            </text>
          </p>
          <br />
          <label for="stack"> Stack/Reserve (reserve ID): </label>
          <input
            :class="formInputStyle"
            name="stack"
            type="text"
            v-model="form.stack"
          />
          <p v-for="error of v$.form.stack.$errors" :key="error.$uid">
            <text class="text-red-500">
              {{ numericOrNullValidationError }}
            </text>
          </p>
          <br />
          <label for="version"> Software version: </label>
          <input
            :class="formInputStyle"
            name="version"
            type="text"
            v-model="form.softwareVersion"
          />
        </template>
        <template v-else> </template>
        <template v-if="devicesWithPorts.includes(form.deviceType)"
          ><br />
          <label for="portsAmount"> Port capacity: </label>
          <input
            :class="formInputStyle"
            placeholder="For switches, patch panels, etc."
            name="portsAmount"
            type="text"
            v-model="form.portsAmount"
          />
          <p v-for="error of v$.form.portsAmount.$errors" :key="error.$uid">
            <text class="text-red-500">
              {{ numericOrNullValidationError }}
            </text>
          </p>
        </template>
        <template v-else> </template>
        <label for="powerType"> Socket type: </label>
        <select :class="formInputStyle" v-model="form.powerType">
          <option value="IEC C14 socket" selected="selected">
            IEC C14 socket
          </option>
          <option value="External power supply">External power supply</option>
          <option value="Clamps">Clamps</option>
          <option value="Passive equipment">Passive equipment</option>
          <option value="Other">Other</option>
        </select>
        <br />
        <label for="powerW"> Power requirement (W): </label>
        <input
          :class="formInputStyle"
          name="powerW"
          type="text"
          v-model="form.powerW"
        />
        <p v-for="error of v$.form.powerW.$errors" :key="error.$uid">
          <text class="text-red-500">
            {{ numericOrNullValidationError }}
          </text>
        </p>
        <br />
        <label for="powerV"> Voltage (V): </label>
        <input
          :class="formInputStyle"
          name="powerV"
          type="text"
          v-model="form.powerV"
        />
        <p v-for="error of v$.form.powerV.$errors" :key="error.$uid">
          <text class="text-red-500">
            {{ numericOrNullValidationError }}
          </text>
        </p>
        <br />
        <label for="powerACDC"> AC/DC: </label>
        <select :class="formInputStyle" v-model="form.powerACDC">
          <option value="AC" selected="selected">AC</option>
          <option value="DC">DC</option>
        </select>
        <br />
        <label for="serialNumber"> Serial number: </label>
        <input
          :class="formInputStyle"
          name="serialNumber"
          type="text"
          v-model="form.serialNumber"
        />
        <br />
        <label for="description"> Description: </label>
        <input
          :class="formInputStyle"
          placeholder="Device purpose"
          name="description"
          type="text"
          v-model="form.description"
        />
        <br />
        <label for="project"> Project: </label>
        <input
          :class="formInputStyle"
          name="project"
          type="text"
          v-model="form.project"
        />
        <br />
        <label for="ownership"> Ownership: </label>
        <input
          :class="formInputStyle"
          name="ownership"
          type="text"
          v-model="form.ownership"
        />
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
  </div>
  <br />
</template>

<script>
import ChooseExistingItem from './ChooseExistingItem.vue';
import useVuelidate from '@vuelidate/core';
import { ipAddress, minValue, numeric, required } from '@vuelidate/validators';
import { getUnique, logIfNotStatus } from '@/api';
import { numericGTZOrNull } from '@/validators';
import { setEmptyStringToNull } from '@/functions';
import {
  DEVICES_WITH_OS,
  DEVICES_WITH_PORTS,
  RESPONSE_STATUS,
} from '@/constants';
import {
  formCheckboxStyle,
  formInputStyle,
  formSubmitButtonStyle,
  frameShadowStyle,
} from '@/styleBindings';

export default {
  name: 'DeviceForm',
  props: {
    form: {
      firstUnit: Number | null,
      lastUnit: Number | null,
      hasBacksideLocation: false,
      status: String,
      deviceType: String,
      vendor: String,
      model: String,
      hostname: String,
      ip: String | null,
      deviceStack: String,
      portsAmount: Number | null,
      softwareVersion: String,
      powerType: String,
      powerW: Number | null,
      powerV: Number | null,
      powerACDC: String,
      serialNumber: String,
      description: String,
      linkToDocs: String,
      project: String,
      ownership: String,
      responsible: String,
      financiallyResponsiblePerson: String,
      inventoryNumber: String,
      fixedAsset: String,
    },
  },
  components: {
    ChooseExistingItem,
  },
  emits: ['onSubmit'],
  data() {
    return {
      v$: useVuelidate(),
      vendorsIsHidden: true,
      modelsIsHidden: true,
      vendors: {},
      models: {},
      numericOrNullValidationError:
        'Value must be an integer and greater than zero',
      devicesWithOS: DEVICES_WITH_OS,
      devicesWithPorts: DEVICES_WITH_PORTS,
      formInputStyle: formInputStyle,
      formSubmitButtonStyle: formSubmitButtonStyle,
      frameShadowStyle: frameShadowStyle,
      formCheckboxStyle: formCheckboxStyle,
    };
  },
  created() {
    this.setVendors();
    this.setModels();
  },
  validations() {
    return {
      form: {
        firstUnit: { required, numeric, minValue: minValue(1) },
        lastUnit: { required, numeric, minValue: minValue(1) },
        ip: { ipAddress },
        stack: { numericGTZOrNull },
        portsAmount: { numericGTZOrNull },
        powerW: { numericGTZOrNull },
        powerV: { numericGTZOrNull },
      },
    };
  },
  methods: {
    /**
     * Submit
     */
    submit() {
      this.v$.$touch();
    },
    /**
     * Fetch and set device vendors
     */
    async setVendors() {
      const response = await getUnique('device vendors', 'device/vendors');
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      this.vendors = response.data.data;
    },
    /**
     * Fetch and set device models
     */
    async setModels() {
      const response = await getUnique('device models', 'device/models');
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      this.models = response.data.data;
    },
    /**
     * Emit data
     */
    emitData() {
      if (this.v$.$errors.length) {
        confirm('Form not valid, please check the fields');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        this.$emit('onSubmit', this.v$);
      } else {
        //Yes, this is a crutch, but quite simple and understandable
        const fieldNamesArr = ['stack', 'portsAmount', 'powerW', 'powerV'];
        this.setEmptyStringToNull(fieldNamesArr, this.form);
        this.v$.$reset();
        this.$emit('onSubmit', this.form);
      }
    },
    setEmptyStringToNull: setEmptyStringToNull,
  },
};
</script>

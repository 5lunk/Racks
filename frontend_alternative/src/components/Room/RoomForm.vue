<template>
  <div :class="frameShadowStyle">
    <form v-on:submit.prevent="emitData" class="text-sm">
      <label for="name"> Room name: </label>
      <input
        id="e2e_room_name"
        :class="formInputStyle"
        placeholder="Enter room name here"
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
      <label for="buildingFloor"> Building floor: </label>
      <input
        id="e2e_room_floor"
        :class="formInputStyle"
        placeholder="Building floor"
        name="buildingFloor"
        type="text"
        v-model="form.buildingFloor"
      />
      <p v-for="error of v$.form.buildingFloor.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ error.$message }}
        </text>
      </p>
      <br />
      <label for="description"> Description: </label>
      <input
        :class="formInputStyle"
        placeholder="Can be used for notes"
        name="description"
        type="text"
        v-model="form.description"
      />
      <br />
      <label for="numberOfRackSpaces"> Number of rack spaces: </label>
      <input
        :class="formInputStyle"
        name="number of rack spaces"
        type="text"
        v-model="form.numberOfRackSpaces"
      />
      <p v-for="error of v$.form.numberOfRackSpaces.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="area"> Area (sq. m): </label>
      <input
        :class="formInputStyle"
        name="area"
        type="text"
        v-model="form.area"
      />
      <p v-for="error of v$.form.area.$errors" :key="error.$uid">
        <text class="text-red-500">
          {{ numericOrNullValidationError }}
        </text>
      </p>
      <br />
      <label for="responsible"> Responsible: </label>
      <input
        :class="formInputStyle"
        name="responsible"
        type="text"
        v-model="form.responsible"
      />
      <br />
      <label for="coolingSystem"> Cooling system: </label>
      <select :class="formInputStyle" v-model="form.coolingSystem">
        <option value="Centralized" selected="selected">Centralized</option>
        <option value="Individual">Individual</option>
        <option value="None">None</option>
      </select>
      <br />
      <label for="fireSuppressionSystem"> Fire suppression system: </label>
      <select :class="formInputStyle" v-model="form.fireSuppressionSystem">
        <option value="Centralized" selected="selected">Centralized</option>
        <option value="Individual">Individual</option>
        <option value="None">None</option>
        <option value="Alarm only">Alarm only</option>
      </select>
      <br />
      <input
        :class="formCheckboxStyle"
        name="accessIsOpen"
        type="checkbox"
        v-model="form.accessIsOpen"
      />
      <label for="accessIsOpen" class="px-2"> Access is open </label>
      <br />
      <br />
      <input
        :class="formCheckboxStyle"
        name="hasRaisedFloor"
        type="checkbox"
        v-model="form.hasRaisedFloor"
      />
      <label for="hasRaisedFloor" class="px-2"> Has raised floor </label>
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
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { numericGTZOrNull } from '@/validators';
import { setEmptyStringToNull } from '@/functions';
import {
  formCheckboxStyle,
  formInputStyle,
  formSubmitButtonStyle,
  frameShadowStyle,
} from '@/styleBindings';

export default {
  name: 'RoomForm',
  props: {
    form: {
      name: String,
      buildingFloor: String,
      description: String,
      numberOfRackSpaces: Number | null,
      area: Number | null,
      responsible: String,
      coolingSystem: String,
      fireSuppressionSystem: String,
      accessIsOpen: Boolean,
      hasRaisedFloor: Boolean,
    },
  },
  emits: ['onSubmit'],
  data() {
    return {
      v$: useVuelidate(),
      formInputStyle: formInputStyle,
      formSubmitButtonStyle: formSubmitButtonStyle,
      frameShadowStyle: frameShadowStyle,
      formCheckboxStyle: formCheckboxStyle,
    };
  },
  validations() {
    return {
      form: {
        name: { required },
        buildingFloor: { required },
        numberOfRackSpaces: { numericGTZOrNull },
        area: { numericGTZOrNull },
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
     * Emit data
     */
    emitData() {
      if (this.v$.$errors.length) {
        confirm('Form not valid, please check the fields');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        this.$emit('onSubmit', this.v$);
      } else {
        // Yes, this is a crutch, but quite simple and understandable
        const fieldNamesArr = ['numberOfRackSpaces', 'area'];
        this.setEmptyStringToNull(fieldNamesArr, this.form);
        this.v$.$reset();
        this.$emit('onSubmit', this.form);
      }
    },
    setEmptyStringToNull: setEmptyStringToNull,
  },
};
</script>

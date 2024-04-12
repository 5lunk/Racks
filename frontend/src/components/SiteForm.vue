<template>
  <div
    class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
  >
    <div :class="frameShadowStyle">
      <form v-on:submit.prevent="emitData" class="text-sm">
        <label for="name"> Site name: </label>
        <input
          id="e2e_site_name"
          :class="formInputStyle"
          placeholder="Enter site name here"
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
        <label for="description"> Description: </label>
        <input
          :class="formInputStyle"
          placeholder="Can be used for notes"
          name="description"
          type="text"
          v-model="form.description"
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
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import {
  formInputStyle,
  formSubmitButtonStyle,
  frameShadowStyle,
} from '@/styleBindings';

export default {
  name: 'SiteForm',
  props: {
    form: {
      name: String,
      description: String,
    },
  },
  emits: ['onSubmit'],
  data() {
    return {
      v$: useVuelidate(),
      formInputStyle: formInputStyle,
      formSubmitButtonStyle: formSubmitButtonStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  validations() {
    return {
      form: {
        name: { required },
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
        this.v$.$reset();
        this.$emit('onSubmit', this.form);
      }
    },
  },
};
</script>

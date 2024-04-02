<template>
  <div class="container px-4 mx-auto justify-between text-xl pl-8 pt-4 font-sans font-light">
    <div class="bg-transparent rounded-lg px-3 py-2 mr-3 mb-3 item-shadow">
      <form
        v-on:submit.prevent="emitData"
        class="text-sm"
      >
        <label for="siteName">
          Building name:
        </label>
        <input
          id="e2e_building_name"
          class="block w-96 rounded-lg border-2 border-blue-400 text-sm"
          placeholder="Enter building name here"
          name="buildingName"
          type="text"
          v-model="form.name"
        />
        <p
          v-for="error of v$.form.name.$errors"
          :key="error.$uid"
        >
          <text class="text-red-500">
            {{error.$message}}
          </text>
        </p>
        <br>
        <label for="description">
          Description:
        </label>
        <input
          class="block w-96 rounded-lg border-2 border-blue-400 text-sm"
          placeholder="Can be used for notes"
          name="description"
          type="text"
          v-model="form.description"
        />
        <br>
        <button
          class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-small rounded-lg text-sm
          px-7 py-0.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          type="submit"
          id="e2e_submit_button"
          v-on:click="submit"
        >
          Submit data
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import {required} from '@vuelidate/validators';


export default {
  name: 'SiteForm',
  props: {
    formProps: {
      type: Object
    }
  },
  data() {
    return {
      v$: useVuelidate(),
      form: {
        name: '',
        description: ''
      }
    }
  },
  created() {
    this.setBuildingFormProps();
  },
  validations() {
    return {
      form: {
        name: {required},
      }
    }
  },
  methods: {
    /**
     * Set building form props
     */
    setBuildingFormProps() {
      if (this.formProps.oldName) {
        this.form.name = this.formProps.oldName;
        this.form.description = this.formProps.oldDescription
      }
    },
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
        window.scrollTo({top: 0, behavior: 'smooth'});
      } else {
        this.$emit('on-submit', this.form);
      }
    },
  }
}
</script>

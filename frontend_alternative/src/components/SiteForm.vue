<template>
  <div class="container px-4 mx-auto justify-between text-xl pl-8 pt-4 font-sans font-light">
    <div :class="frameShadowStyle">
      <form
        v-on:submit.prevent="emitData"
        class="text-sm"
      >
        <label for="name">
          Site name:
        </label>
        <input
          id="e2e_site_name"
          :class="formInputStyle"
          placeholder="Enter site name here"
          name="name"
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
          :class="formInputStyle"
          placeholder="Can be used for notes"
          name="description"
          type="text"
          v-model="form.description"
        />
        <br>
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
  <br>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import {required} from '@vuelidate/validators';
import {formInputStyle, formSubmitButtonStyle, frameShadowStyle} from '@/styleBindings';


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
      },
      formInputStyle: formInputStyle,
      formSubmitButtonStyle: formSubmitButtonStyle,
      frameShadowStyle: frameShadowStyle
    }
  },
  created() {
    this.setSiteFormProps();
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
     * Set site form props
     */
    setSiteFormProps() {
      if (this.formProps.oldName) {
        this.form.name = this.formProps.oldName;
        this.form.description = this.formProps.oldDescription;
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
        confirm("Form not valid, please check the fields");
        window.scrollTo({top: 0, behavior: 'smooth'});
      } else {
        this.$emit('on-submit', this.form);
      }
    },
  }
}
</script>

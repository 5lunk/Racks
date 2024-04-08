<template>
  <div
    v-bind="{
      itemsData: itemsData,
      isHidden: isHidden,
    }"
  >
    <label :for="inputId"> {{ label }}: </label>
    <input
      :class="formInputStyle"
      :id="inputId"
      type="text"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <button
      type="button"
      class="pb-2 pl-56 text-slate-500"
      v-on:click="isHidden = !isHidden"
    >
      <text class="text-blue-300"> &#9873; </text>
      Choose from existing
    </button>
    <div v-if="!isHidden">
      <template v-for="item in itemsData.items">
        <template v-if="item.length">
          <button
            type="button"
            :class="chooseButtonDarkStyle"
            :id="item"
            v-on:click="copyOnClick(item, inputId)"
          >
            {{ item }}
          </button>
        </template>
      </template>
    </div>
    <br />
  </div>
</template>

<script>
import { MATCH_ID, MATCH_LABEL } from '@/constants';
import { getDataFromMatch } from '@/functions';
import {
  chooseButtonDarkStyle,
  formInputStyle,
  optionButtonDarkStyle,
} from '@/styleBindings';

export default {
  name: 'ChooseExistingItem',
  props: {
    itemsData: Object,
    isHidden: Boolean,
    modelValue: String,
  },
  data() {
    return {
      inputId: '',
      label: '',
      formInputStyle: formInputStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      chooseButtonDarkStyle: chooseButtonDarkStyle,
    };
  },
  created() {
    this.inputId = this.getDataFromMatch(this.itemsData.item_type, MATCH_ID);
    this.label = this.getDataFromMatch(this.itemsData.item_type, MATCH_LABEL);
  },
  methods: {
    /**
     * Copy button text to input
     * @param {String} choice Button id
     * @param {String} id Input id
     */
    copyOnClick(choice, id) {
      let event = new Event('input');
      let input = document.getElementById(id);
      input.value = document.getElementById(choice).innerText;
      input.dispatchEvent(event);
    },
    getDataFromMatch: getDataFromMatch,
  },
};
</script>

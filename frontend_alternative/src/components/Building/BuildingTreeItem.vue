<template>
  <div
    v-bind="{
      id: id,
      name: name,
      isOpen: isOpen,
    }"
    class="mb-4"
  >
    <span :class="getCaretClass(isOpen)" :id="getId(name, null, null)">
      <text class="px-2">
        {{ truncate(name, truncationLength.DEFAULT) }}
      </text>
      <router-link :to="{ path: `/room/create/${id}` }">
        <button
          :id="getId(name, 'add', 'button')"
          :class="optionButtonDarkStyle"
        >
          Add room
        </button>
      </router-link>
      <router-link :to="{ path: `/building/${id}` }">
        <button :class="optionButtonLightStyle">Info</button>
      </router-link>
    </span>
  </div>
</template>

<script>
import { getCaretClass, getId } from '@/functions';
import { truncate } from '@/filters';
import { TRUNCATION_LENGTH } from '@/constants';
import { optionButtonDarkStyle, optionButtonLightStyle } from '@/styleBindings';

export default {
  name: 'BuildingTreeItem',
  data() {
    return {
      truncationLength: TRUNCATION_LENGTH,
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
    };
  },
  props: {
    id: Number,
    name: String,
    isOpen: Boolean,
  },
  methods: {
    getCaretClass: getCaretClass,
    getId: getId,
    truncate: truncate,
  },
};
</script>

<style scoped>
@import '@/css/tree.css';
</style>

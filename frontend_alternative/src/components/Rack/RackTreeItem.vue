<template>
  <div
    v-bind="{
      id: id,
      name: name,
      isOpen: isOpen,
    }"
  >
    <span>
      <router-link :to="{ path: `/units/${id}` }">
        <text class="text-blue-300"> &#9873; </text>
        <a :id="getId(name, null, null)" class="group transition duration-300">
          {{ truncate(name, truncationLength.RACK) }}
          <span
            class="block h-1 max-w-0 bg-blue-500 transition-all duration-500 group-hover:max-w-prose"
          ></span>
        </a>
      </router-link>
    </span>
  </div>
</template>

<script>
import { getId } from '@/functions';
import { truncate } from '@/filters';
import { TRUNCATION_LENGTH } from '@/constants';

export default {
  name: 'RackTreeItem',
  data() {
    return {
      truncationLength: TRUNCATION_LENGTH,
    };
  },
  props: {
    id: Number,
    name: String,
    isOpen: Boolean,
  },
  methods: {
    getId: getId,
    truncate: truncate,
  },
};
</script>

<style scoped>
@import '@/css/tree.css';
</style>

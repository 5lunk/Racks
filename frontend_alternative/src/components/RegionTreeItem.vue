<template>
  <div v-bind="{
      name: name,
      isOpen: isOpen
    }"
    class="mb-4"
  >
    <span 
      :class="getCaretClass(isOpen)"
      :id="getId(name, null, null)"
    >
    <text class="px-2">
      {{truncate(name, truncationLength.DEFAULT)}}
    </text>
    </span>
  </div>
</template>

<script>
import {getCaretClass, getId} from '@/functions'
import {truncate} from '@/filters'
import {TRUNCATION_LENGTH} from "@/constants";

export default {
  name: 'RegionTreeItem',
  data () {
    return {
      truncationLength: TRUNCATION_LENGTH
    }
  },
  props: {
    name: String,
    isOpen: Boolean
  },
  methods: {
    getCaretClass: getCaretClass,
    getId: getId,
    truncate: truncate
  }
}
</script>

<style scoped>
  @import '@/css/tree.css';
</style>
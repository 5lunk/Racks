<template>
  <div v-bind="{
      id: id,
      name: name,
      isOpen: isOpen
    }"
    class="mb-2"
  >
    <span
      :class="getCaretClass(isOpen)"
      :id="getId(name, null, null)"
    >
      <text class="px-2">
        {{truncate(name, truncationLength.DEFAULT)}}
      </text>
      <router-link
        :to="{path: `/building/create/${id}`}"
        target="_blank"
      >
        <button
          :id="getId(name, 'add', 'button')"
          class="text-white font-light bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-small rounded-lg text-xs
          px-4 py-0.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 align-[2px]"
        >
          Add building
        </button>
      </router-link>
      <router-link
        :to="{path: `/site/${id}`}"
        target="_blank">
        <button
          class="text-white font-light bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-small rounded-lg text-xs
          px-4 py-0.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 align-[2px]"
        >
          Info
        </button>
      </router-link>
    </span>
  </div>
</template>

<script>
import {getCaretClass, getId} from '@/functions'
import {truncate} from '@/filters'
import {TRUNCATION_LENGTH} from "@/constants";

export default {
  name: 'SiteTreeItem',
  data () {
    return {
      truncationLength: TRUNCATION_LENGTH
    }
  },
  props: {
    id: Number,
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

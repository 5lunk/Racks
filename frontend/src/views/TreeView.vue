<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    ></div>
    <div
      class="container mx-auto flex flex-wrap justify-between px-4 pl-8 font-sans text-xl font-thin tracking-tight"
    >
      <ul class="w-full">
        <li v-for="treeData in regions">
          <TreeItem :item="treeData" />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import TreeItem from '@/components/TreeItem.vue';

export default {
  name: 'TreeView',
  components: {
    TreeItem,
  },
  created() {
    this.$store.dispatch('getTree');
  },
  computed: {
    regions() {
      return this.$store.getters.tree;
    },
  },
};
</script>

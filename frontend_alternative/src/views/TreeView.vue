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
import TheMessage from '@/components/TheMessage.vue';
import TreeItem from '@/components/TreeItem.vue';
import { getUnique, logIfNotStatus } from '@/api';
import { RESPONSE_STATUS } from '@/constants';

export default {
  name: 'TreeView',
  components: {
    TreeItem,
    TheMessage,
  },
  data() {
    return {
      regions: {},
      messageProps: {
        message: '',
        success: false,
      },
    };
  },
  created() {
    this.getTreeData();
  },
  methods: {
    /**
     * Fetch and set tree data
     */
    async getTreeData() {
      const response = await getUnique('tree', 'tree');
      logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
      this.regions = response.data.data;
    },
  },
};
</script>

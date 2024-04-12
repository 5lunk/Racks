<template>
  <li :class="frameShadowStyle">
    <RegionTreeItem
      v-if="item.region_name"
      :name="item.region_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <DepartmentTreeItem
      v-if="item.department_name"
      :id="item.id"
      :name="item.department_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <SiteTreeItem
      v-if="item.site_name"
      :id="item.id"
      :name="item.site_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <BuildingTreeItem
      v-if="item.building_name"
      :id="item.id"
      :name="item.building_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <RoomTreeItem
      v-if="item.room_name"
      :id="item.id"
      :name="item.room_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <RackTreeItem
      v-if="item.rack_name"
      :id="item.id"
      :name="item.rack_name"
      :isOpen="isOpen"
      v-on:click="toggle()"
    />
    <ul v-show="isOpen" v-if="hasChildren">
      <TreeItem v-for="child in item.children" :item="child" />
    </ul>
  </li>
</template>

<script>
import RegionTreeItem from './Region/RegionTreeItem.vue';
import DepartmentTreeItem from './Department/DepartmentTreeItem.vue';
import SiteTreeItem from './Site/SiteTreeItem.vue';
import BuildingTreeItem from './Building/BuildingTreeItem.vue';
import RoomTreeItem from './Room/RoomTreeItem.vue';
import RackTreeItem from './Rack/RackTreeItem.vue';
import { truncate } from '@/filters';
import { getCaretClass, getId } from '@/functions';
import { frameShadowStyle } from '@/styleBindings';

export default {
  name: 'TreeItem',
  props: {
    item: Object,
  },
  components: {
    RegionTreeItem,
    DepartmentTreeItem,
    SiteTreeItem,
    BuildingTreeItem,
    RoomTreeItem,
    RackTreeItem,
  },
  data() {
    return {
      isOpen: false,
      frameShadowStyle: frameShadowStyle,
    };
  },
  computed: {
    /**
     * Item has children?
     */
    hasChildren() {
      return this.item.children && this.item.children.length;
    },
  },
  methods: {
    /**
     * Open tree level
     */
    toggle() {
      if (this.hasChildren) {
        this.isOpen = !this.isOpen;
      }
    },
    getCaretClass: getCaretClass,
    getId: getId,
    truncate: truncate,
  },
};
</script>

<style scoped>
ul {
  padding-left: 1em;
  line-height: 1.5em;
}
</style>

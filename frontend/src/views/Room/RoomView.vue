<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-light"
    >
      <TheMessage :message="roomMessage" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-xl font-light"
    >
      <div :class="frameShadowStyle">
        Room №{{ room.id }}
        <router-link :to="{ path: `/room/${room.id}/update` }">
          <button :class="optionButtonDarkStyle">Edit</button>
        </router-link>
        <button :class="optionButtonLightStyle" v-on:click.prevent="deleteRoom">
          Delete
        </button>
        <br />
        <div class="pb-2 text-xs text-slate-500">
          {{ roomLocation.regionName }} &#9002;
          {{ roomLocation.departmentName }} &#9002;
          {{ roomLocation.siteName }} &#9002;
          {{ roomLocation.buildingName }}
        </div>
        <div class="text-xs">
          Updated by:
          <text class="text-slate-500">
            {{ room.updatedBy }}
          </text>
          <br />
          Updated at:
          <text class="text-slate-500">
            {{ room.updatedAt }}
          </text>
        </div>
      </div>
      <div class="text-sm">
        <div :class="frameShadowStyle">
          Room name:
          <text class="text-slate-500">
            {{ room.name }}
          </text>
          <br />
          Building floor:
          <text class="text-slate-500">
            {{ room.buildingFloor }}
          </text>
          <br />
          Description:
          <text class="text-slate-500">
            {{ room.description }}
          </text>
          <br />
          Number of rack spaces:
          <text class="text-slate-500">
            {{ room.numberOfRackSpaces }}
          </text>
          <br />
          Area (sq. m):
          <text class="text-slate-500">
            {{ room.area }}
          </text>
          <br />
          Responsible:
          <text class="text-slate-500">
            {{ room.responsible }}
          </text>
          <br />
          Cooling system:
          <text class="text-slate-500">
            {{ room.coolingSystem }}
          </text>
          <br />
          Fire suppression system:
          <text class="text-slate-500">
            {{ room.fireSuppressionSystem }}
          </text>
          <br />
          <template v-if="room.accessIsOpen">
            Active ventilation:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Active ventilation:
            <text class="text-slate-500"> No </text>
          </template>
          <br />
          <template v-if="room.hasRaisedFloor">
            Active ventilation:
            <text class="text-slate-500"> Yes </text>
          </template>
          <template v-else>
            Active ventilation:
            <text class="text-slate-500"> No </text>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TheMessage from '@/components/TheMessage.vue';
import {
  frameShadowStyle,
  optionButtonDarkStyle,
  optionButtonLightStyle,
} from '@/styleBindings';

export default {
  name: 'RoomView',
  components: {
    TheMessage,
  },
  data() {
    return {
      optionButtonLightStyle: optionButtonLightStyle,
      optionButtonDarkStyle: optionButtonDarkStyle,
      frameShadowStyle: frameShadowStyle,
    };
  },
  created() {
    this.$store.dispatch('getRoom', this.$route.params.id);
    this.$store.dispatch('getRoomLocation', this.$route.params.id);
  },
  computed: {
    room() {
      return this.$store.getters.room;
    },
    roomLocation() {
      return this.$store.getters.roomLocation;
    },
    roomMessage() {
      return this.$store.getters.roomMessage;
    },
    roomDeleted() {
      return this.$store.getters.roomDeleted;
    },
    noSuchRoom() {
      return this.$store.getters.noSuchRoom;
    },
  },
  watch: {
    roomDeleted(deleted) {
      if (deleted) {
        alert(this.roomMessage.text);
        this.$router.push({ name: 'TreeView' });
      }
    },
    noSuchRoom(notFound) {
      if (notFound) {
        this.$router.push({ name: 'PageNotFoundView' });
      }
    },
  },
  methods: {
    deleteRoom() {
      if (
        confirm(
          `Do you really want to delete room ${this.room.name} and all related items?`,
        )
      ) {
        this.$store.dispatch('deleteRoom', this.room.id);
      }
    },
  },
};
</script>

<template>
  <div class="min-h-screen">
    <div
      class="container mx-auto justify-between px-4 pl-8 font-sans text-xl font-thin"
    >
      <TheMessage :message="message" />
    </div>
    <div
      class="container mx-auto justify-between px-4 pl-8 pt-4 font-sans text-sm font-light"
    >
      <RoomForm :form="form" v-on:on-submit="submitForm" />
    </div>
  </div>
</template>

<script>
import RoomForm from '@/components/Room/RoomForm.vue';
import TheMessage from '@/components/TheMessage.vue';

export default {
  name: 'RoomAddView',
  components: {
    RoomForm,
    TheMessage,
  },
  computed: {
    form() {
      return this.$store.getters.room;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  created() {
    this.$store.commit('setRoomDefaults');
  },
  methods: {
    /**
     * Submit room form
     * @param {Object} form Room form
     */
    submitForm(form) {
      this.$store.dispatch('submitRoomFormForCreate', {
        form: form,
        buildingId: parseInt(this.$route.params.building_id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

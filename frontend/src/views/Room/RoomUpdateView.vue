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
  name: 'RoomUpdateView',
  components: {
    RoomForm,
    TheMessage,
  },
  created() {
    this.$store.dispatch('getRoom', parseInt(this.$route.params.id));
  },
  computed: {
    form() {
      return this.$store.getters.room;
    },
    message() {
      return this.$store.getters.message;
    },
  },
  methods: {
    /**
     * Submit room form
     * @param {Object} form Room form
     */
    submitForm(form) {
      this.$store.dispatch('submitRoomFormForUpdate', {
        form: form,
        id: parseInt(this.$route.params.id),
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

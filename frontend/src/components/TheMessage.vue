<template>
  <template v-if="message.text.length && message.success">
    <text>
      {{ message.text }}
    </text>
  </template>
  <template v-else-if="message.text.length && !message.success">
    <text class="text-red-500">
      {{ message.text }}
    </text>
  </template>
  <template v-else>
    <text></text>
  </template>
</template>

<script>
export default {
  name: 'TheMessage',
  props: {
    message: {
      text: String,
      success: Boolean,
    },
  },
  mounted() {
    this.$store.commit('setMessageDefaults');
  }
};
</script>

<template>
  <template v-if="message.text.length">
  <text :class="messageStyle">
    {{ message.text }}
    <sup>
      <button class="text-xm text-slate-500 sups"
              v-on:click="acknowledge">
        &#215;
      </button>
    </sup>
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
  computed: {
    messageStyle() {
      if (this.message.text.length && !this.message.success) {
        return 'text-red-500';
      }
      return ''
    }
  },
  mounted() {
    this.$store.commit('setMessageDefaults');
  },
  methods: {
    acknowledge() {
      this.$store.commit('setMessageDefaults');
    }
  }
};
</script>
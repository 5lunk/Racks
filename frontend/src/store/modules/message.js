const state = {
  message: {
    text: '',
    success: false,
  },
};

const getters = {
  message: (state) => {
    return state.message;
  },
};

const mutations = {
  setMessage(state, message) {
    state.message.text = message.text;
    state.message.success = message.success;
  },
  setMessageDefaults(state) {
    state.message.text = '';
    state.message.success = false;
  },
};

export default {
  state, mutations, getters
}
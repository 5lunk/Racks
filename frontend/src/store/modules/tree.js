import { RESPONSE_STATUS } from '@/constants';
import { getUnique, logIfNotStatus } from '@/api';

const state = {
  tree: {},
};

const getters = {
  tree: (state) => {
    return state.tree;
  },
};

const actions = {
  /**
   * Fetch and set tree data
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async getTree({ commit }) {
    const response = await getUnique('tree', 'tree');
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setTree', response.data.data);
  },
};

const mutations = {
  setTree(state, tree) {
    state.tree = tree;
  },
};
export default {
  state, mutations, actions, getters
}

import {
  deleteObject,
  getObject,
  getObjectLocation,
  getResponseMessage,
  logIfNotStatus,
  postObject,
  putObject,
} from '@/api';
import { RESPONSE_STATUS } from '@/constants';

const state = {
  site: {
    id: null,
    name: '',
    description: '',
    updatedBy: '',
    updatedAt: '',
  },
  siteLocation: {
    departmentName: '',
    regionName: '',
  },
  siteDeleted: false,
  noSuchSite: false,
};

const getters = {
  site: (state) => {
    return state.site;
  },
  siteLocation: (state) => {
    return state.siteLocation;
  },
  siteDeleted: (state) => {
    return state.siteDeleted;
  },
  noSuchSite: (state) => {
    return state.noSuchSite;
  }
};

const actions = {
  /**
   * Fetch and set site data
   * @param {commit} commit
   * @param {Number} id Site id
   */
  async getSite({ commit }, id) {
    const response = await getObject('site', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      commit('setNoSuchSite', true)
    }
    commit('setSite', response.data.data);
  },
  /**
   * Delete site
   * @param {commit} commit
   * @param {Number} id Site id
   * @param {String} name Site name
   */
  async deleteSite({ commit }, id) {
    const response = await deleteObject('site', id);
    if (response.status === RESPONSE_STATUS.NO_CONTENT) {
      commit('setMessage', {
        text: `Site ${id} deleted successfully`,
        success: true,
      });
      commit('setSiteDeleted', true);
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
  /**
   * Fetch and set site location
   * @param {commit} commit
   * @param {Number} id Site id
   */
  async getSiteLocation({ commit }, id) {
    const response = await getObjectLocation('site', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setSiteLocation', response.data.data);
  },
  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} departmentId Department id
   * @returns {Promise<void>}
   */
  async submitSiteFormForCreate({ commit }, { form, departmentId }) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      description: form.description,
      department_id: departmentId,
    };
    const response = await postObject('site', formData);
    if (response.status === RESPONSE_STATUS.CREATED) {
      commit('setMessage', {
        text: `Site ${response.data.data.name} added successfully`,
        success: true,
      });
      commit('setSiteDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
  /**
   * Submit update form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} id Site id
   * @returns {Promise<void>}
   */
  async submitSiteFormForUpdate({ commit }, { form, id }) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      description: form.description,
    };
    const response = await putObject('site', id, formData);
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      commit('setMessage', {
        text: `Site ${response.data.data.name} updated successfully`,
        success: true,
      });
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
};

const mutations = {
  setSite(state, site) {
    state.site.id = site.id;
    state.site.name = site.name;
    state.site.description = site.description;
    state.site.updatedBy = site.updated_by;
    state.site.updatedAt = site.updated_at;
  },
  setSiteLocation(state, siteLocation) {
    state.siteLocation.departmentName = siteLocation.department_name;
    state.siteLocation.regionName = siteLocation.region_name;
  },
  setSiteDefaults(state) {
    state.site.name = '';
    state.site.description = '';
  },
  setSiteDeleted(state, siteDeleted) {
    state.siteDeleted = siteDeleted;
  },
  setNoSuchSite(state, noSuchSite) {
    state.noSuchSite = noSuchSite;
  }
};
export default {
  state, mutations, actions, getters
}

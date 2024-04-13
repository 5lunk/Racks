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
import router from '@/router';

const state = {
  building: {
    id: null,
    name: '',
    description: '',
    updatedBy: '',
    updatedAt: '',
  },
  message: {
    text: '',
    success: false,
  },
  location: {
    siteName: '',
    departmentName: '',
    regionName: '',
  },
};

const getters = {
  building: state => {
    return state.building;
  },
  message: state => {
    return state.message;
  },
  location: state => {
    return state.location;
  }
};

const actions = {
  /**
   * Fetch and set building data
   * @param {commit} commit
   * @param {Number} id Building id
   */
  async getBuilding({commit}, id) {
    const response = await getObject('building', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      await router.push({ name: 'PageNotFoundView' });
    }
    commit('setBuilding', response.data.data)
  },
  /**
   * Delete building
   * @param {commit} commit
   * @param {Number} id Building id
   * @param {String} name Building name
   */
  async deleteBuilding({commit}, {id, name}) {
    if (
      confirm(
        `Do you really want to delete building ${name} and all related items?`,
      )
    ) {
      const response = await deleteObject('building', id);
      if (response.status === RESPONSE_STATUS.NO_CONTENT) {
        const message = {
          text: `Building ${id} deleted successfully`,
          success: true,
        };
        commit('setMessage', message);
        alert(message.text);
        await router.push({ name: 'TreeView' });
      } else {
        const message = {
          text: getResponseMessage(response),
          success: false,
        };
        commit('setMessage', message);
      }
    }
  },
  /**
   * Fetch and set building location
   * @param {commit} commit
   * @param {Number} id Building id
   */
  async getBuildingLocation({commit}, id) {
    const response = await getObjectLocation('building', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setLocation', response.data.data);
  },
  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} siteId Site id
   * @returns {Promise<void>}
   */
  async submitFormForCreate({commit}, {form, siteId}) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      description: form.description,
      site_id: siteId,
    };
    const response = await postObject('building', formData);
    if (response.status === RESPONSE_STATUS.CREATED) {
      const message = {
        text: `Building ${response.data.data.name} added successfully`,
        success: true,
      };
      commit('setMessage', message);
      commit('setBuildingDefaults');
    } else {
      const message = {
        text: getResponseMessage(response),
        success: false,
      };
      commit('setMessage', message);
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
  },
  /**
   * Submit update form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} id Building id
   * @returns {Promise<void>}
   */
  async submitFormForUpdate({commit}, {form, id}) {
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
    const response = await putObject(
      'building',
      id,
      formData,
    );
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      const message = {
        text: `Building ${response.data.data.name} updated successfully`,
        success: true,
      };
      commit('setMessage', message);
    } else {
      const message = {
        text: getResponseMessage(response),
        success: false,
      };
      commit('setMessage', message);
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
  },
};

const mutations = {
  setBuilding(state, building) {
    state.building.id = building.id;
    state.building.name = building.name;
    state.building.description = building.description;
    state.building.updatedBy = building.updated_by;
    state.building.updatedAt = building.updated_at;
  },
  setMessage(state, message) {
    state.message.text = message.text;
    state.message.success = message.success;
  },
  setLocation(state, location) {
    state.location = location;
    state.location.siteName = location.site_name;
    state.location.departmentName = location.department_name;
    state.location.regionName = location.region_name;
  },
  setBuildingDefaults(state) {
    state.building.name = '';
    state.building.description = '';
  },
  setMessageDefaults(state) {
    state.message.text = '';
    state.message.success = false;
  }
};

export default {
  state, mutations, actions, getters
}
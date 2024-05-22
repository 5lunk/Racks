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
  building: {
    id: null,
    name: '',
    description: '',
    updatedBy: '',
    updatedAt: '',
  },
  buildingLocation: {
    siteName: '',
    departmentName: '',
    regionName: '',
  },
  buildingDeleted: false,
  noSuchBuilding: false,
};

const getters = {
  building: (state) => {
    return state.building;
  },
  buildingLocation: (state) => {
    return state.buildingLocation;
  },
  buildingDeleted: (state) => {
    return state.buildingDeleted;
  },
  noSuchBuilding: (state) => {
    return state.noSuchBuilding;
  }
};

const actions = {
  /**
   * Fetch and set building data
   * @param {commit} commit
   * @param {Number} id Building id
   */
  async getBuilding({ commit }, id) {
    const response = await getObject('building', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      commit('setNoSuchBuilding', true)
    }
    commit('setBuilding', response.data.data);
  },
  /**
   * Delete building
   * @param {commit} commit
   * @param {Number} id Building id
   * @param {String} name Building name
   */
  async deleteBuilding({ commit }, id) {
      const response = await deleteObject('building', id);
      if (response.status === RESPONSE_STATUS.NO_CONTENT) {
        commit('setMessage', {
          text: `Building ${id} deleted successfully`,
          success: true,
        });
        commit('setBuildingDeleted', true);
        commit('setBuildingDefaults');
      } else {
        commit('setMessage', {
          text: getResponseMessage(response),
          success: false,
        });
      }
  },
  /**
   * Fetch and set building location
   * @param {commit} commit
   * @param {Number} id Building id
   */
  async getBuildingLocation({ commit }, id) {
    const response = await getObjectLocation('building', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setBuildingLocation', response.data.data);
  },
  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} siteId Site id
   * @returns {Promise<void>}
   */
  async submitBuildingFormForCreate({ commit }, { form, siteId }) {
    // If form not valid
    if (form.$errors) {
      commit('setDefaults');
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
      commit('setMessage', {
        text: `Building ${response.data.data.name} added successfully`,
        success: true,
      });
      commit('setBuildingDefaults');
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
   * @param {Number} id Building id
   * @returns {Promise<void>}
   */
  async submitBuildingFormForUpdate({ commit }, { form, id }) {
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
    const response = await putObject('building', id, formData);
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      commit('setMessage', {
        text: `Building ${response.data.data.name} updated successfully`,
        success: true,
      });
      commit('setBuildingDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
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
  setBuildingLocation(state, buildingLocation) {
    state.buildingLocation.siteName = buildingLocation.site_name;
    state.buildingLocation.departmentName = buildingLocation.department_name;
    state.buildingLocation.regionName = buildingLocation.region_name;
  },
  setBuildingDefaults(state) {
    state.building.name = '';
    state.building.description = '';
  },
  setBuildingDeleted(state, buildingDeleted) {
    state.buildingDeleted = buildingDeleted;
  },
  setNoSuchBuilding(state, noSuchBuilding) {
    state.noSuchBuilding = noSuchBuilding;
  }
};

export default {
  state, mutations, actions, getters
}

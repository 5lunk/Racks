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
  room: {
    id: null,
    buildingFloor: '',
    numberOfRackSpaces: null,
    area: null,
    responsible: '',
    coolingSystem: 'Centralized',
    fireSuppressionSystem: 'Centralized',
    accessIsOpen: false,
    hasRaisedFloor: false,
    name: '',
    description: '',
    updatedBy: '',
    updatedAt: '',
  },
  roomLocation: {
    buildingName: '',
    siteName: '',
    departmentName: '',
    regionName: '',
  },
  roomDeleted: false,
  noSuchRoom: false,
};

const getters = {
  room: (state) => {
    return state.room;
  },
  roomLocation: (state) => {
    return state.roomLocation;
  },
  roomDeleted: (state) => {
    return state.roomDeleted;
  },
  noSuchRoom: (state) => {
    return state.noSuchRoom;
  }
};

const actions = {
  /**
   * Fetch and set room data
   * @param {commit} commit
   * @param {Number} id Room id
   */
  async getRoom({ commit }, id) {
    const response = await getObject('room', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      commit('setNoSuchRoom', true)
    }
    commit('setRoom', response.data.data);
  },
  /**
   * Delete room
   * @param {commit} commit
   * @param {Number} id Room id
   * @param {String} name Room name
   */
  async deleteRoom({ commit }, id) {
    const response = await deleteObject('room', id);
    if (response.status === RESPONSE_STATUS.NO_CONTENT) {
      commit('setMessage', {
        text: `Room ${id} deleted successfully`,
        success: true,
      });
      commit('setRoomDeleted', true);
      commit('setRoomDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
  /**
   * Fetch and set room location
   * @param {commit} commit
   * @param {Number} id Room id
   */
  async getRoomLocation({ commit }, id) {
    const response = await getObjectLocation('room', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setRoomLocation', response.data.data);
  },
  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {Number} buildingId Building id
   * @returns {Promise<void>}
   */
  async submitRoomFormForCreate({ commit }, { form, buildingId }) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      building_floor: form.buildingFloor,
      description: form.description,
      number_of_rack_spaces: form.numberOfRackSpaces,
      area: form.area,
      responsible: form.responsible,
      cooling_system: form.coolingSystem,
      fire_suppression_system: form.fireSuppressionSystem,
      access_is_open: form.accessIsOpen,
      has_raised_floor: form.hasRaisedFloor,
      building_id: buildingId,
    };
    const response = await postObject('room', formData);
    if (response.status === RESPONSE_STATUS.CREATED) {
      commit('setMessage', {
        text: `Room ${response.data.data.name} added successfully`,
        success: true,
      });
      commit('setRoomDefaults');
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
   * @param {Number} id Room id
   * @returns {Promise<void>}
   */
  async submitRoomFormForUpdate({ commit }, { form, id }) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      building_floor: form.buildingFloor,
      description: form.description,
      number_of_rack_spaces: form.numberOfRackSpaces,
      area: form.area,
      responsible: form.responsible,
      cooling_system: form.coolingSystem,
      fire_suppression_system: form.fireSuppressionSystem,
      access_is_open: form.accessIsOpen,
      has_raised_floor: form.hasRaisedFloor,
    };
    const response = await putObject('room', id, formData);
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      commit('setMessage', {
        text: `Room ${response.data.data.name} updated successfully`,
        success: true,
      });
      commit('setRoomDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
};

const mutations = {
  setRoom(state, room) {
    state.room.id = room.id;
    state.room.name = room.name;
    state.room.buildingFloor = room.building_floor;
    state.room.description = room.description;
    state.room.numberOfRackSpaces = room.number_of_rack_spaces;
    state.room.area = room.area;
    state.room.responsible = room.responsible;
    state.room.coolingSystem = room.cooling_system;
    state.room.fireSuppressionSystem = room.fire_suppression_system;
    state.room.accessIsOpen = room.access_is_open;
    state.room.hasRaisedFloor = room.has_raised_floor;
    state.room.updatedBy = room.updated_by;
    state.room.updatedAt = room.updated_at;
  },
  setRoomLocation(state, roomLocation) {
    state.roomLocation.buildingName = roomLocation.building_name;
    state.roomLocation.siteName = roomLocation.site_name;
    state.roomLocation.departmentName = roomLocation.department_name;
    state.roomLocation.regionName = roomLocation.region_name;
  },
  setRoomDefaults(state) {
    state.room.buildingFloor = '';
    state.room.numberOfRackSpaces = null;
    state.room.area = null;
    state.room.responsible = '';
    state.room.coolingSystem = 'Centralized';
    state.room.fireSuppressionSystem = 'Centralized';
    state.room.accessIsOpen = false;
    state.room.hasRaisedFloor = false;
    state.room.name = '';
    state.room.description = '';
  },
  setRoomDeleted(state, roomDeleted) {
    state.roomDeleted = roomDeleted;
  },
  setNoSuchRoom(state, noSuchRoom) {
    state.noSuchRoom = noSuchRoom;
  }
};
export default {
  state, mutations, actions, getters
}

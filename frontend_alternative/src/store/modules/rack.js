import {
  deleteObject,
  getObject,
  getObjectLocation,
  getResponseMessage,
  getUnique,
  logIfNotStatus,
  postObject,
  putObject,
} from '@/api';
import { RESPONSE_STATUS } from '@/constants';

const state = {
  rack: {
    name: '',
    amount: null,
    vendor: '',
    model: '',
    description: '',
    hasNumberingFromTopToBottom: false,
    responsible: '',
    financiallyResponsiblePerson: '',
    inventoryNumber: '',
    fixedAsset: '',
    link: '',
    row: '',
    place: '',
    height: null,
    width: null,
    depth: null,
    unitWidth: null,
    unitDepth: null,
    executionType: 'Rack',
    frame: 'Double frame',
    placeType: 'Floor standing',
    maxLoad: null,
    powerSockets: null,
    powerSocketsUps: null,
    hasExternalUps: false,
    hasCooler: false,
    updatedBy: '',
    updatedAt: '',
  },
  rackLocation: {
    roomName: '',
    buildingName: '',
    siteName: '',
    departmentName: '',
    regionName: '',
  },
  rackVendors: {
    itemType: '',
    items: [],
  },
  rackModels: {
    itemType: '',
    items: [],
  },
  rackDeleted: false,
  noSuchRack: false,
};

const getters = {
  rack: state => {
    return state.rack;
  },
  rackLocation: state => {
    return state.rackLocation;
  },
  rackVendors: state => {
    return state.rackVendors;
  },
  rackModels: state => {
    return state.rackModels;
  },
  rackDeleted: state => {
    return state.rackDeleted;
  },
  noSuchRack: state => {
    return state.noSuchRack;
  }
};

const actions = {
  /**
   * Fetch and set rack data
   * @param {commit} commit
   * @param {Number} id Rack id
   */
  async getRack({commit}, id) {
    const response = await getObject('rack', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      commit('setNoSuchRack', true)
    }
    commit('setRack', response.data.data)
  },
  /**
   * Delete rack
   * @param {commit} commit
   * @param {Number} id Rack id
   */
  async deleteRack({commit}, id) {
      const response = await deleteObject('rack', id);
      if (response.status === RESPONSE_STATUS.NO_CONTENT) {
        commit('setMessage', {
          text: `Rack ${id} deleted successfully`,
          success: true,
        });
        commit('setRackDeleted', true);
      } else {
        commit('setMessage', {
          text: getResponseMessage(response),
          success: false,
        });
      }
  },
  /**
   * Fetch and set rack location
   * @param {commit} commit
   * @param {Number} id Rack id
   */
  async getRackLocation({commit}, id) {
    const response = await getObjectLocation('rack', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setRackLocation', response.data.data);
  },
  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {String} roomId Room id
   * @returns {Promise<void>}
   */
  async submitRackFormForCreate({commit}, {form, roomId}) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const formData = {
      name: form.name,
      amount: parseInt(form.amount),
      vendor: form.vendor,
      model: form.model,
      description: form.description,
      has_numbering_from_top_to_bottom: form.hasNumberingFromTopToBottom,
      responsible: form.responsible,
      financially_responsible_person: form.financiallyResponsiblePerson,
      inventory_number: form.inventoryNumber,
      fixed_asset: form.fixedAsset,
      link_to_docs: form.linkToDocs,
      row: form.row,
      place: form.place,
      height: form.height,
      width: form.width,
      depth: form.depth,
      unit_width: form.unitWidth,
      unit_depth: form.unitDepth,
      type: form.executionType,
      frame: form.frame,
      place_type: form.placeType,
      max_load: form.maxLoad,
      power_sockets: form.powerSockets,
      power_sockets_ups: form.powerSocketsUps,
      has_external_ups: form.hasExternalUps,
      has_cooler: form.hasCooler,
      room_id: parseInt(roomId),
    };
    const response = await postObject('rack', formData);
    if (response.status === RESPONSE_STATUS.CREATED) {
      commit('setMessage', {
        text: `Rack ${response.data.data.name} added successfully`,
        success: true,
      });
      commit('setRackDefaults');
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
   * @param {Number} id Rack id
   * @returns {Promise<void>}
   */
  async submitRackFormForUpdate({commit}, {form, id}) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    // Amount update not allowed
    const formData = {
      name: form.name,
      vendor: form.vendor,
      model: form.model,
      description: form.description,
      has_numbering_from_top_to_bottom: form.hasNumberingFromTopToBottom,
      responsible: form.responsible,
      financially_responsible_person: form.financiallyResponsiblePerson,
      inventory_number: form.inventoryNumber,
      fixed_asset: form.fixedAsset,
      link: form.link,
      row: form.row,
      place: form.place,
      height: form.height,
      width: form.width,
      depth: form.depth,
      unit_width: form.unitWidth,
      unit_depth: form.unitDepth,
      type: form.executionType,
      frame: form.frame,
      place_type: form.placeType,
      max_load: form.maxLoad,
      power_sockets: form.powerSockets,
      power_sockets_ups: form.powerSocketsUps,
      has_external_ups: form.hasExternalUps,
      has_cooler: form.hasCooler,
    };
    const response = await putObject(
      'rack',
      id,
      formData,
    );
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      commit('setMessage', {
        text: `Rack ${response.data.data.name} updated successfully`,
        success: true,
      })
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
  /**
   * Get rack vendors
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async getRackVendors({commit}) {
    const response = await getUnique('rack vendors', 'rack/vendors');
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setRackVendors', response.data.data);
  },
  /**
   * Get rack models
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async getRackModels({commit}) {
    const response = await getUnique('rack models', 'rack/models');
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setRackModels', response.data.data);
  },
};

const mutations = {
  setRack(state, rack) {
    state.rack.id = rack.id;
    state.rack.name = rack.name;
    state.rack.amount = rack.amount;
    state.rack.vendor = rack.vendor;
    state.rack.model = rack.model;
    state.rack.description = rack.description;
    state.rack.hasNumberingFromTopToBottom = rack.has_numbering_from_top_to_bottom;
    state.rack.responsible = rack.responsible;
    state.rack.financiallyResponsiblePerson = rack.financially_responsible_person;
    state.rack.inventoryNumber = rack.inventory_number;
    state.rack.fixedAsset = rack.fixed_asset;
    state.rack.linkToDocs = rack.link_to_docs;
    state.rack.row = rack.row;
    state.rack.place = rack.place;
    state.rack.height = rack.height;
    state.rack.width = rack.width;
    state.rack.depth = rack.depth;
    state.rack.unitWidth = rack.unit_width;
    state.rack.unitDepth = rack.unit_depth;
    state.rack.executionType = rack.type;
    state.rack.frame = rack.frame;
    state.rack.placeType = rack.place_type;
    state.rack.maxLoad = rack.max_load;
    state.rack.powerSockets = rack.power_sockets;
    state.rack.powerSocketsUps = rack.power_sockets_ups;
    state.rack.hasExternalUps = rack.has_external_ups;
    state.rack.hasCooler = rack.has_cooler;
    state.rack.updatedBy = rack.updated_by;
    state.rack.updatedAt = rack.updated_at;
  },
  setRackLocation(state, rackLocation) {
    state.rackLocation.roomName = rackLocation.room_name;
    state.rackLocation.buildingName = rackLocation.building_name;
    state.rackLocation.siteName = rackLocation.site_name;
    state.rackLocation.departmentName = rackLocation.department_name;
    state.rackLocation.regionName = rackLocation.region_name;
  },
  setRackVendors(state, rackVendors) {
    state.rackVendors.items = rackVendors.items;
    state.rackVendors.itemType = rackVendors.item_type;
  },
  setRackModels(state, rackModels) {
    state.rackModels.items = rackModels.items;
    state.rackModels.itemType = rackModels.item_type;
  },
  setRackDefaults(state) {
    state.rack.name = '';
    state.rack.amount = null;
    state.rack.vendor = '';
    state.rack.model = '';
    state.rack.description = '';
    state.rack.hasNumberingFromTopToBottom = false;
    state.rack.responsible = '';
    state.rack.financiallyResponsiblePerson = '';
    state.rack.inventoryNumber = '';
    state.rack.fixedAsset = '';
    state.rack.link = '';
    state.rack.row = '';
    state.rack.place = '';
    state.rack.height = null;
    state.rack.width = null;
    state.rack.depth = null;
    state.rack.unitWidth = null;
    state.rack.unitDepth = null;
    state.rack.executionType = 'Rack';
    state.rack.frame = 'Double frame';
    state.rack.placeType = 'Floor standing';
    state.rack.maxLoad = null;
    state.rack.powerSockets = null;
    state.rack.powerSocketsUps = null;
    state.rack.hasExternalUps = false;
    state.rack.hasCooler = false;
  },
  setRackDeleted(state, rackDeleted) {
    state.rackDeleted = rackDeleted;
  },
  setNoSuchRack(state, noSuchRack) {
    state.noSuchRack = noSuchRack;
  }
};

export default {
  state, mutations, actions, getters
}
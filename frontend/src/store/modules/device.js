import {
  deleteObject,
  getObject,
  getObjectLocation,
  getObjectsForParent,
  getResponseMessage,
  getUnique,
  logIfNotStatus,
  postObject,
  putObject,
} from '@/api';
import { RESPONSE_STATUS } from '@/constants';
import { getUnitsArray } from '@/functions';

const state = {
  device: {
    firstUnit: null,
    lastUnit: null,
    units: [],
    hasBacksideLocation: false,
    status: 'Device active',
    deviceType: 'Other',
    vendor: '',
    model: '',
    hostname: '',
    ip: null,
    stack: null,
    portsAmount: null,
    softwareVersion: '',
    powerType: 'IEC C14 socket',
    powerW: null,
    powerV: null,
    powerACDC: 'AC',
    serialNumber: '',
    description: '',
    linkToDocs: '',
    project: '',
    ownership: 'Our department',
    responsible: '',
    financiallyResponsiblePerson: '',
    inventoryNumber: '',
    fixedAsset: '',
    rackId: null,
  },
  deviceLocation: {
    rackName: '',
    roomName: '',
    buildingName: '',
    siteName: '',
    departmentName: '',
    regionName: '',
  },
  deviceVendors: {
    itemType: '',
    items: [],
  },
  deviceModels: {
    itemType: '',
    items: [],
  },
  devicesForRack: [],
  deviceDeleted: false,
  noSuchDevice: false,
};

const getters = {
  device: state => {
    return state.device;
  },
  deviceLocation: state => {
    return state.deviceLocation;
  },
  deviceVendors: state => {
    return state.deviceVendors;
  },
  deviceModels: state => {
    return state.deviceModels;
  },
  devicesForRack: state => {
    return state.devicesForRack;
  },
  deviceDeleted: state => {
    return state.deviceDeleted;
  },
  noSuchDevice: state => {
    return state.noSuchDevice;
  }
};

const actions = {
  /**
   * Fetch and set device data
   * @param {commit} commit
   * @param {Number} id Rack id
   */
  async getDevice({commit}, id) {
    const response = await getObject('device', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    if (response.status === RESPONSE_STATUS.NOT_FOUND) {
      commit('setNoSuchDevice', true)
    }
    commit('setDevice', response.data.data)
  },
  /**
   * Fetch and set devices for single rack
   * @param {commit} commit
   * @param id Rack id
   * @returns {Promise<void>}
   */
  async getDevicesForRack({commit}, id) {
    const response = await getObjectsForParent(
      'devices',
      'rack',
      id,
    );
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setDevicesForRack', response.data.data)
  },
  /**
   * Delete device
   * @param {commit} commit
   * @param {Number} id Device id
   */
  async deleteDevice({commit}, id) {
    const response = await deleteObject('device', id);
    if (response.status === RESPONSE_STATUS.NO_CONTENT) {
      commit('setMessage', {
        text: `Device ${id} deleted successfully`,
        success: true,
      });
      commit('setDeviceDeleted', true);
      commit('setDeviceDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      })
    }
  },
  /**
   * Fetch and set device location
   * @param {commit} commit
   * @param {String} id Device id
   */
  async getDeviceLocation({commit}, id){
    const response = await getObjectLocation('device', id);
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setDeviceLocation', response.data.data);
  },

  /**
   * Submit add form
   * @param {commit} commit
   * @param {Object} form form
   * @param {String} rackId Rack id
   * @returns {Promise<void>}
   */
  async submitDeviceFormForCreate({commit}, {form, rackId}) {
    // If form not valid
    if (form.$errors) {
      commit('setDeviceMessageDefaults');
      return;
    }
    // If form valid
    const firstUnit = parseInt(form.firstUnit);
    const lastUnit = parseInt(form.lastUnit);
    const formData = {
      units: getUnitsArray(firstUnit, lastUnit),
      has_backside_location: form.hasBacksideLocation,
      status: form.status,
      type: form.deviceType,
      vendor: form.vendor,
      model: form.model,
      hostname: form.hostname,
      ip: form.ip,
      stack: form.stack,
      ports_amount: form.portsAmount,
      software_version: form.softwareVersion,
      power_type: form.powerType,
      power_w: form.powerW,
      power_v: form.powerV,
      power_ac_dc: form.powerACDC,
      serial_number: form.serialNumber,
      description: form.description,
      link_to_docs: form.linkToDocs,
      project: form.project,
      ownership: form.ownership,
      responsible: form.responsible,
      financially_responsible_person: form.financiallyResponsiblePerson,
      inventory_number: form.inventoryNumber,
      fixed_asset: form.fixedAsset,
      rack_id: rackId,
    };
    const response = await postObject('device', formData);
    if (response.status === RESPONSE_STATUS.CREATED) {
      commit('setMessage', {
        text: `Device ${response.data.data.vendor} ${response.data.data.model} added successfully`,
        success: true,
      });
      commit('setDeviceDefaults');
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
   * @param {Number} id Device id
   * @returns {Promise<void>}
   */
  async submitDeviceFormForUpdate({commit}, {form, id}) {
    // If form not valid
    if (form.$errors) {
      commit('setMessageDefaults');
      return;
    }
    // If form valid
    const firstUnit = parseInt(form.firstUnit);
    const lastUnit = parseInt(form.lastUnit);
    const formData = {
      units: getUnitsArray(firstUnit, lastUnit),
      has_backside_location: form.hasBacksideLocation,
      status: form.status,
      type: form.deviceType,
      vendor: form.vendor,
      model: form.model,
      hostname: form.hostname,
      ip: form.ip,
      stack: form.stack,
      ports_amount: form.portsAmount,
      software_version: form.softwareVersion,
      power_type: form.powerType,
      power_w: form.powerW,
      power_v: form.powerV,
      power_ac_dc: form.powerACDC,
      serial_number: form.serialNumber,
      description: form.description,
      project: form.project,
      ownership: form.ownership,
      responsible: form.responsible,
      financially_responsible_person: form.financiallyResponsiblePerson,
      inventory_number: form.inventoryNumber,
      fixed_asset: form.fixedAsset,
    };
    const response = await putObject(
      'device',
      id,
      formData,
    );
    if (response.status === RESPONSE_STATUS.ACCEPTED) {
      commit('setMessage', {
        text: `Device ${response.data.data.vendor} ${response.data.data.model} updated successfully`,
        success: true,
      });
      commit('setDeviceDefaults');
    } else {
      commit('setMessage', {
        text: getResponseMessage(response),
        success: false,
      });
    }
  },
  /**
   * Get device vendors
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async getDeviceVendors({commit}) {
    const response = await getUnique('device vendors', 'device/vendors');
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setDeviceVendors', response.data.data);
  },
  /**
   * Get device models
   * @param {commit} commit
   * @returns {Promise<void>}
   */
  async getDeviceModels({commit}) {
    const response = await getUnique('device models', 'device/models');
    logIfNotStatus(response, RESPONSE_STATUS.OK, 'Unexpected response!');
    commit('setDeviceModels', response.data.data);
  },
};

const mutations = {
  setDevice(state, device) {
    state.device.id = device.id;
    state.device.firstUnit = device.units[0];
    state.device.lastUnit = device.units[device.units.length - 1];
    state.device.units = getUnitsArray(state.device.firstUnit, state.device.lastUnit);
    state.device.hasBacksideLocation = device.has_backside_location;
    state.device.status = device.status;
    state.device.deviceType = device.type;
    state.device.vendor = device.vendor;
    state.device.model = device.model;
    state.device.hostname = device.hostname;
    state.device.ip = device.ip;
    state.device.stack = device.stack;
    state.device.portsAmount = device.ports_amount;
    state.device.softwareVersion = device.software_version;
    state.device.powerType = device.power_type;
    state.device.powerW = device.power_w;
    state.device.powerV = device.power_v;
    state.device.powerACDC = device.power_ac_dc;
    state.device.serialNumber = device.serial_number;
    state.device.description = device.description;
    state.device.project = device.project;
    state.device.ownership = device.ownership;
    state.device.responsible = device.responsible;
    state.device.financiallyResponsiblePerson = device.financially_responsible_person;
    state.device.inventoryNumber = device.inventory_number;
    state.device.fixedAsset = device.fixed_asset;
    state.device.rackId= device.rack_id;
    state.device.updatedBy = device.updated_by;
    state.device.updatedAt = device.updated_at;
  },
  setDeviceLocation(state, deviceLocation) {
    state.deviceLocation.rackName = deviceLocation.rack_name;
    state.deviceLocation.roomName = deviceLocation.room_name;
    state.deviceLocation.buildingName = deviceLocation.building_name;
    state.deviceLocation.siteName = deviceLocation.site_name;
    state.deviceLocation.departmentName = deviceLocation.department_name;
    state.deviceLocation.regionName = deviceLocation.region_name;
  },
  setDeviceVendors(state, deviceVendors) {
    state.deviceVendors.items = deviceVendors.items;
    state.deviceVendors.itemType = deviceVendors.item_type;
  },
  setDeviceModels(state, deviceModels) {
    state.deviceModels.items = deviceModels.items;
    state.deviceModels.itemType = deviceModels.item_type;
  },
  setDeviceDefaults(state) {
    state.device.firstUnit = null;
    state.device.lastUnit = null;
    state.device.units = [];
    state.device.hasBacksideLocation = false;
    state.device.status = 'Device active';
    state.device.deviceType = 'Other';
    state.device.vendor = '';
    state.device.model = '';
    state.device.hostname = '';
    state.device.ip = null;
    state.device.stack = null;
    state.device.portsAmount = null;
    state.device.softwareVersion = '';
    state.device.powerType = 'IEC C14 socket';
    state.device.powerW = null;
    state.device.powerV = null;
    state.device.powerACDC = 'AC';
    state.device.serialNumber = '';
    state.device.description = '';
    state.device.project = '';
    state.device.ownership = '';
    state.device.responsible = '';
    state.device.financiallyResponsiblePerson = '';
    state.device.inventoryNumber = '';
    state.device.fixedAsset = '';
  },
  setDevicesForRack(state, devicesForRack) {
    state.devicesForRack = devicesForRack;
  },
  setDeviceDeleted(state, deviceDeleted) {
    state.deviceDeleted = deviceDeleted;
  },
  setNoSuchDevice(state, noSuchDevice) {
    state.noSuchDevice = noSuchDevice;
  }
};

export default {
  state, mutations, actions, getters
}
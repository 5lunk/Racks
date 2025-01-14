import axios from 'axios';
import store from '@/store';
import { BASE_PATH, RESPONSE_STATUS } from '@/constants';

const api = new axios.create({
  baseURL: process.env.VUE_APP_AXIOS_URL,
});

const controller = new AbortController();

api.interceptors.request.use( config => {
  config.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
  return {
    ...config,
    signal: controller.signal,
  };
});

api.interceptors.response.use(response => {
  return response;
},  error => {
  if (error.response.data.message === 'Token has expired') {
    store.commit('setTokenNeedsRefresh', true);
    controller.abort();
  }
  return Promise.reject(error);
});

/**
 * Log error
 * @param {Object} error Error object
 * @param {String} objName Object name
 * @param {String} method Method name
 */
function logError(error, objName, method) {
  console.log(`Something went wrong, cant ${method} ${objName}`);
  console.error(error.response);
}

/**
 * Console log if response !status
 * @param {Object} response Response
 * @param {Number} status Status code
 * @param {String} message Helper message
 */
export function logIfNotStatus(response, status, message) {
  if (response.status !== status) {
    console.log(message);
    console.log(response);
  }
}

/**
 * Get return message
 * @param {Object} response Response
 * @returns {String} message
 */
export function getResponseMessage(response) {
  if (response.status === RESPONSE_STATUS.INTERNAL_SERVER_ERROR) {
    return response.data.message;
  }
  return response.data.data.message;
}

/**
 * GET object
 * @param {String} objName Object name
 * @param {Number} id Object id
 * @returns {Promise} Response
 */
export async function getObject(objName, id) {
  try {
    return await api.get(`${BASE_PATH}/${objName}/${id}`);
  } catch (error) {
    logError(error, objName, 'get');
    return error.response;
  }
}

/**
 * POST object
 * @param {String} objName Object name
 * @param {Object} formData Form data
 * @returns {Promise} Response
 */
export async function postObject(objName, formData) {
  try {
    return await api.post(`${BASE_PATH}/${objName}`, formData);
  } catch (error) {
    logError(error, objName, 'post');
    return error.response;
  }
}

/**
 * PUT object
 * (technically it is PATCH, because API uses patch for more flexibility,
 * but client app sends all fields, so on this level it is called PUT)
 * @param {String} objName Object name
 * @param {Object} formData Form data
 * @param {Number} id Object id
 * @returns {Promise} Response
 */
export async function putObject(objName, id, formData) {
  try {
    return await api.patch(`${BASE_PATH}/${objName}/${id}`, formData);
  } catch (error) {
    logError(error, objName, 'put');
    return error.response;
  }
}

/**
 * DELETE object
 * @param {String} objName Object name
 * @param {Number} id Object id
 * @returns {Promise} Response
 */
export async function deleteObject(objName, id) {
  try {
    return await api.delete(`${BASE_PATH}/${objName}/${id}`);
  } catch (error) {
    logError(error, objName, 'delete');
    return error.response;
  }
}

/**
 * GET Object location
 * @param {String} objName Object name
 * @param {Number} id Object id
 * @returns {Promise} Response
 */
export async function getObjectLocation(objName, id) {
  try {
    return await api.get(`${BASE_PATH}/${objName}/${id}/location`);
  } catch (error) {
    logError(error, `${objName} location`, 'get');
    return error.response;
  }
}

/**
 * GET object for FK
 * @param {String} objNamePlural Object name plural
 * @param {String} parentName Parent object name
 * @param {Number} parenId Parent object id
 * @returns {Promise} Response
 */
export async function getObjectsForParent(objNamePlural, parentName, parenId) {
  try {
    return await api.get(
      `${BASE_PATH}/${parentName}/${parenId}/${objNamePlural}`,
    );
  } catch (error) {
    logError(error, `${objNamePlural} for ${parentName}`, 'get');
    return error.response;
  }
}

/**
 * GET object unique endpoint
 * @param {String} objName Object name
 * @param {String} subPath Path
 * @returns {Promise} Response
 */
export async function getUnique(objName, subPath) {
  try {
    return await api.get(`${BASE_PATH}/${subPath}`);
  } catch (error) {
    logError(error, objName, 'get');
    return error.response;
  }
}

export default api;
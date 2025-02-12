<template>
  <table
    v-bind="{
      side: side,
      devices: devices,
      firstUnits: firstUnits,
      rowSpans: rowSpans,
      startList: startList,
    }"
    class="side mx-auto w-full max-w-2xl table-fixed divide-y divide-gray-300 overflow-hidden whitespace-nowrap rounded-t-lg bg-white font-sans text-sm tracking-tight drop-shadow-2xl"
  >
    <thead class="bg-gray-500">
      <tr class="text-center text-white">
        <th class="w-4 px-6 py-4 text-sm font-semibold uppercase">
          {{ side }}
        </th>
        <th class="w-35 px-6 py-4 text-sm font-semibold uppercase"></th>
        <th class="w-8 px-6 py-4 text-sm font-semibold uppercase"></th>
      </tr>
    </thead>
    <tbody class="divide-y-2 divide-gray-300">
      <template v-for="list in startList">
        <tr>
          <td class="px-4 py-2 text-black">
            {{ list }}
          </td>
          <template v-for="device in devices">
            <template v-for="(firstUnit, deviceNumber) in firstUnits">
              <template v-if="firstUnit === list">
                <template v-if="keyToInt(deviceNumber) === device.id">
                  <template v-for="(rowspan, deviceId) in rowSpans">
                    <template v-if="keyToInt(deviceId) === device.id">
                      <template v-if="device.status === deviceStatus.ACTIVE">
                        <template
                          v-if="device.ownership === deviceOwnership.OUR"
                        >
                          <UnitItem
                            :className="`text-center font-normal text-white rounded-lg ${classNameOur}`"
                            :vendor="device.vendor"
                            :model="device.model"
                            :id="device.id"
                            :type="device.type"
                            :rowspan="rowspan"
                          />
                        </template>
                        <template v-else>
                          <UnitItem
                            :className="`text-center font-normal text-white rounded-lg ${classNameAlien}`"
                            :vendor="device.vendor"
                            :model="device.model"
                            :id="device.id"
                            :type="device.type"
                            :rowspan="rowspan"
                          />
                        </template>
                      </template>
                      <template v-else>
                        <template
                          v-if="device.ownership === deviceOwnership.OUR"
                        >
                          <UnitItem
                            :className="`text-center font-normal text-white rounded-lg ${classNameEmpty} ${classNameOur}`"
                            :vendor="device.vendor"
                            :model="device.model"
                            :id="device.id"
                            :type="device.type"
                            :rowspan="rowspan"
                          />
                        </template>
                        <template v-else>
                          <UnitItem
                            :className="`text-center font-normal text-white rounded-lg ${classNameAlien} ${classNameEmpty}`"
                            :vendor="device.vendor"
                            :model="device.model"
                            :id="device.id"
                            :type="device.type"
                            :rowspan="rowspan"
                          />
                        </template>
                      </template>
                    </template>
                  </template>
                </template>
              </template>
            </template>
          </template>
        </tr>
      </template>
    </tbody>
  </table>
</template>

<script>
import UnitItem from '@/components/UnitItem.vue';
import { DEVICE_OWNERSHIP, DEVICE_STATUS } from '@/constants';

export default {
  name: 'RackSideItem',
  data() {
    return {
      deviceOwnership: DEVICE_OWNERSHIP,
      deviceStatus: DEVICE_STATUS,
    };
  },
  components: {
    UnitItem,
  },
  inheritAttrs: false,
  props: {
    side: {
      type: String,
      default: '',
    },
    devices: {
      type: Array,
      default: [],
    },
    firstUnits: {
      type: Object,
      default: {},
    },
    rowSpans: {
      type: Object,
      default: {},
    },
    startList: {
      type: Array,
      default: [],
    },
    classNameOur: {
      type: String,
      default: 'bg-blue-600',
    },
    classNameAlien: {
      type: String,
      default: 'bg-blue-400',
    },
    classNameEmpty: {
      type: String,
      default: 'line-through',
    },
  },
  methods: {
    keyToInt(value) {
      return parseInt(value);
    },
  },
};
</script>

<style>
.side {
  margin: 1rem;
}
</style>

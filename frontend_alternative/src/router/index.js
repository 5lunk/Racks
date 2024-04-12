import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '@/views/LoginView.vue';
import DeviceView from '@/views/Device/DeviceView.vue';
import RackView from '@/views/Rack/RackView.vue';
import RoomView from '@/views/Room/RoomView.vue';
import BuildingView from '@/views/Building/BuildingView.vue';
import SiteView from '@/views/Site/SiteView.vue';
import TreeView from '@/views/TreeView.vue';
import UnitsView from '@/views/UnitsView.vue';
import SiteAddView from '@/views/Site/SiteAddView.vue';
import SiteUpdateView from '@/views/Site/SiteUpdateView.vue';
import RackAddView from '@/views/Rack/RackAddView.vue';
import RackUpdateView from '@/views/Rack/RackUpdateView.vue';
import DeviceAddView from '@/views/Device/DeviceAddView.vue';
import DeviceUpdateView from '@/views/Device/DeviceUpdateView.vue';
import BuildingAddView from '@/views/Building/BuildingAddView.vue';
import BuildingUpdateView from '@/views/Building/BuildingUpdateView.vue';
import RoomAddView from '@/views/Room/RoomAddView.vue';
import RoomUpdateView from '@/views/Room/RoomUpdateView.vue';
import PageNotFoundView from '@/views/PageNotFoundView.vue';

const routes = [
  {
    path: '/',
    name: 'TreeView',
    component: TreeView,
  },
  {
    path: '/login',
    name: 'LoginView',
    component: LoginView,
  },
  {
    path: '/device/:id',
    name: 'DeviceView',
    component: DeviceView,
  },
  {
    path: '/rack/:id',
    name: 'RackView',
    component: RackView,
  },
  {
    path: '/room/:id',
    name: 'RoomView',
    component: RoomView,
  },
  {
    path: '/building/:id',
    name: 'BuildingView',
    component: BuildingView,
  },
  {
    path: '/site/:id',
    name: 'SiteView',
    component: SiteView,
  },
  {
    path: '/units/:id',
    name: 'UnitsView',
    component: UnitsView,
  },
  {
    path: '/site/create/:department_id',
    name: 'SiteAddView',
    component: SiteAddView,
  },
  {
    path: '/site/:id/update',
    name: 'SiteUpdateView',
    component: SiteUpdateView,
  },
  {
    path: '/building/create/:site_id',
    name: 'BuildingAddView',
    component: BuildingAddView,
  },
  {
    path: '/building/:id/update',
    name: 'BuildingUpdateView',
    component: BuildingUpdateView,
  },
  {
    path: '/room/create/:building_id',
    name: 'RoomAddView',
    component: RoomAddView,
  },
  {
    path: '/room/:id/update',
    name: 'RoomUpdateView',
    component: RoomUpdateView,
  },
  {
    path: '/rack/create/:room_id',
    name: 'RackAddView',
    component: RackAddView,
  },
  {
    path: '/rack/:id/update',
    name: 'RackUpdateView',
    component: RackUpdateView,
  },
  {
    path: '/device/create/:rack_id',
    name: 'DeviceAddView',
    component: DeviceAddView,
  },
  {
    path: '/device/:id/update',
    name: 'DeviceUpdateView',
    component: DeviceUpdateView,
  },
  {
    path: '/404',
    name: 'PageNotFoundView',
    component: PageNotFoundView,
  },
  {
    path: '/:pathMatch(.*)*',
    component: PageNotFoundView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (token || to.name === 'LoginView') {
    next();
  } else {
    next({ name: 'LoginView' });
  }
});

export default router;

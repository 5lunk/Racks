import { createStore } from 'vuex';
import building from '@/store/modules/building';
import rack from '@/store/modules/rack';
import device from '@/store/modules/device';
import auth from '@/store/modules/auth';
import tree from '@/store/modules/tree';
import room from '@/store/modules/room';
import site from '@/store/modules/site';
import message from '@/store/modules/message';

export default createStore({
  modules: {
    message,
    building,
    rack,
    device,
    auth,
    tree,
    room,
    site,
  },
});

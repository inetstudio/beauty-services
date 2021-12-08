import hash from 'object-hash';
import { v4 as uuidv4 } from 'uuid';

window.Admin.vue.stores['beauty-services-package_services'] = new window.Vuex.Store({
  state: {
    emptyService: {
      model: {
        is_main: 0,
        title: '',
        description: '',
        href: '',
        date_start: null,
        date_end: null,
        created_at: null,
        updated_at: null,
        deleted_at: null,
      },
      isModified: false,
      hash: '',
    },
    service: {},
    mode: '',
  },
  mutations: {
    setService(state, service) {
      let emptyService = JSON.parse(JSON.stringify(state.emptyService));
      emptyService.model.id = uuidv4();

      let resultService = _.merge(emptyService, service);
      resultService.hash = hash(resultService.model);

      state.service = resultService;
    },
    setMode(state, mode) {
      state.mode = mode;
    }
  }
});

window.Admin.vue.stores['beauty-services-package_services'] = new Vuex.Store({
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
      emptyService.model.id = UUID.generate();

      let resultService = _.merge(emptyService, service);
      resultService.hash = window.hash(resultService.model);

      state.service = resultService;
    },
    setMode(state, mode) {
      state.mode = mode;
    }
  }
});

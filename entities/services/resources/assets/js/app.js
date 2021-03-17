require('./plugins/tinymce/plugins/beauty_service');

require('../../../../../../widgets/entities/widgets/resources/assets/js/mixins/widget');

require('./stores/beauty_services');

Vue.component(
    'BeautyServiceWidget',
    require('./components/partials/BeautyServiceWidget/BeautyServiceWidget.vue').default,
);

let service = require('./package/beauty_services');
service.init();

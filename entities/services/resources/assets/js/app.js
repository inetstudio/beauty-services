require('./plugins/tinymce/plugins/beauty_service');

require('../../../../../../widgets/entities/widgets/resources/assets/js/mixins/widget');

require('./stores/beauty_services');

window.Vue.component(
    'BeautyServiceWidget',
    () => import('./components/partials/BeautyServiceWidget/BeautyServiceWidget.vue'),
);

let service = require('./package/beauty_services');
service.init();

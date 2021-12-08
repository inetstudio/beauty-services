import {beauty_services} from './package/beauty_services';

require('./plugins/tinymce/plugins/beauty_service');

require('../../../../../../widgets/entities/widgets/resources/assets/js/mixins/widget');

require('./stores/beauty_services');

window.Vue.component(
    'BeautyServiceWidget',
    () => import('./components/partials/BeautyServiceWidget/BeautyServiceWidget.vue'),
);

beauty_services.init();

<template>
  <div id="add_beauty_service_widget_modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal inmodal fade" ref="modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
          <h1 class="modal-title">Выберите сервис</h1>
        </div>
        <div class="modal-body">
          <div class="ibox-content" v-bind:class="{ 'sk-loading': options.loading }">
            <div class="sk-spinner sk-spinner-double-bounce">
              <div class="sk-double-bounce1"></div>
              <div class="sk-double-bounce2"></div>
            </div>

            <base-autocomplete
                ref="service_suggestion"
                label="Сервис"
                name="service_suggestion"
                v-bind:value="model.additional_info.title"
                v-bind:attributes="{
                    'data-search': suggestionsUrl,
                    'placeholder': 'Выберите сервис',
                    'autocomplete': 'off'
                }"
                v-on:select="suggestionSelect"
            />

            <base-wysiwyg
                label = "Текст"
                name = "service_text"
                v-bind:value.sync="model.params.text"
                v-bind:simple = true
                v-bind:attributes = "{
                    'id': 'service_text',
                    'cols': '50',
                    'rows': '10',
                }"
            />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
          <a href="#" class="btn btn-primary" v-on:click.prevent="save">Сохранить</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BeautyServiceWidget',
  data() {
    return {
      model: this.getDefaultModel(),
      options: {
        loading: true,
      },
      events: {
        widgetLoaded: function(component) {
          let url = route('back.beauty-services-package.services.show', component.model.params.id).toString();

          component.options.loading = true;

          axios.get(url).then(response => {
            $(component.$refs.service_suggestion.$refs.autocomplete).val(response.data.title).trigger('change');
            window.tinymce.get('service_text').setContent(_.get(component.model.params, 'text', ''));

            component.options.loading = false;
          });
        },
      },
    };
  },
  computed: {
    suggestionsUrl() {
      return route('back.beauty-services-package.services.getSuggestions').toString();
    },
    modalServiceState() {
      return window.Admin.vue.stores['beauty-services-package_services'].state.mode;
    },
  },
  watch: {
    modalServiceState: function(newMode) {
      if (newMode === 'service_created') {
        let service = window.Admin.vue.stores['beauty-services-package_services'].state.service;

        this.model.params.id = service.model.id;

        this.save();
      }
    },
  },
  methods: {
    getDefaultModel() {
      return _.merge(this.getDefaultWidgetModel(), {
        view: 'admin.module.beauty-services.services::front.partials.content.service_widget'
      });
    },
    initComponent() {
      let component = this;

      component.model = _.merge(component.model, this.widget.model);
      component.options.loading = false;
    },
    suggestionSelect(payload) {
      let component = this;

      let data = payload.data;

      component.model.params.id = data.id;
      component.model.additional_info = _.merge(component.model.additional_info, data);
    },
    save() {
      let component = this;

      if (! _.get(component.model.params, 'id')) {
        $(component.$refs.modal).modal('hide');

        return;
      }

      component.saveWidget(function() {
        $(component.$refs.modal).modal('hide');
      });
    }
  },
  created: function() {
    this.initComponent();
  },
  mounted() {
    let component = this;

    this.$nextTick(function() {
      $(component.$refs.modal).on('hide.bs.modal', function() {
        component.model = component.getDefaultModel();
        window.tinymce.get('service_text').setContent('');
      });
    });
  },
  mixins: [
    window.Admin.vue.mixins['widget'],
  ],
};
</script>

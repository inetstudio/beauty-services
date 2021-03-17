window.tinymce.PluginManager.add('beauty_service', function(editor) {
  let widgetData = {
    widget: {
      events: {
        widgetSaved: function(model) {
          editor.execCommand(
              'mceReplaceContent',
              false,
              '<img class="content-widget" data-type="beauty_service" data-id="' + model.id + '" alt="Виджет-сервис: '+model.additional_info.title+'" />',
          );
        }
      }
    }
  };

  function loadWidget() {
    let component = window.Admin.vue.helpers.getVueComponent('beauty-services-package', 'BeautyServiceWidget');

    component.$data.model.id = widgetData.model.id;
  }

  editor.addButton('add_service_widget', {
    title: 'Сервис',
    icon: 'fa fa-percent',
    onclick: function() {
      editor.focus();

      let content = editor.selection.getContent();
      let isService = /<img class="content-widget".+data-type="beauty_service".+>/g.test(content);

      if (content === '' || isService) {
        widgetData.model = {
          id: parseInt($(content).attr('data-id')) || 0,
        };

        window.Admin.vue.helpers.initComponent('beauty-services-package', 'BeautyServiceWidget', widgetData);

        window.waitForElement('#add_beauty_service_widget_modal', function() {
          loadWidget();

          $('#add_beauty_service_widget_modal').modal();
        });
      } else {
        swal({
          title: 'Ошибка',
          text: 'Необходимо выбрать виджет-сервис',
          type: 'error',
        });

        return false;
      }
    }
  });
});

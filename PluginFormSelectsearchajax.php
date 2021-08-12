<?php
class PluginFormSelectsearchajax{
  public function widget_include(){
    wfPlugin::enable('wf/embed');
    $element = array();
    $element[] = wfDocument::createWidget('wf/embed', 'embed', array('type' => 'script', 'file' => '/plugin/form/selectsearchajax/js/PluginFormSelectsearchajax.js'));
    wfDocument::renderElement($element);
  }
  public function widget_select($d){
    $d = new PluginWfArray($d);
    if(!$d->get('data/id')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param id is not set!');
    }
    if(!$d->get('data/url')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param url is not set!');
    }
    if(!$d->get('data/row')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param row is not set!');
    }
    if(!$d->get('data/row/value')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param row/value is not set!');
    }
    if(!$d->get('data/row/text')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param row/text is not set!');
    }
    if(!$d->get('data/field')){
      throw new Exception(__CLASS__.':'.__FUNCTION__.' says: Param field is not set!');
    }
    /**
     * data
     */
    $data = new PluginWfArray();
    $data->set('id', $d->get('data/id'));
    $data->set('id_modal', 'modal_'.$d->get('data/id'));
    $data->set('id_dialog', 'modal_'.$d->get('data/id').'_dialog');
    $data->set('id_content', 'modal_'.$d->get('data/id').'_content');
    $data->set('id_modal_dismiss', 'modal_'.$d->get('data/id').'_modal_dismiss');
    $data->set('id_body', 'modal_'.$d->get('data/id').'_body');
    $data->set('id_footer', 'modal_'.$d->get('data/id').'_footer');
    $data->set('id_form', 'modal_form_'.$d->get('data/id'));
    $data->set('id_table', 'modal_table_'.$d->get('data/id'));
    $data->set('url', $d->get('data/url'));
    $data->set('form_input', $d->get('data/form_input'));
    $data->set('row', $d->get('data/row'));
    $data->set('field', $d->get('data/field'));
    $data->set('form_hide', $d->get('data/form_hide'));
    /**
     * widget
     */
    $widget = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    /**
     * form_input
     */
    if(!$data->get('form_input')){
      $form_input = new PluginWfYml(__DIR__.'/element/form_input.yml');
      $data->set('form_input', $form_input->get());
    }
    /**
     * script row click
     */
    $script = "$('#modal_table_[id] tbody').on( 'click', 'tr', function (a) {  document.getElementById('[id]').value=datatable_modal_table_[id].row( this ).data().[row_value]; document.getElementById('text_[id]').innerHTML=datatable_modal_table_[id].row( this ).data().[row_text]; $('#modal_[id]').modal('hide');  } );";
    $script = str_replace('[id]', $data->get('id'), $script);
    $script = str_replace('[row_value]', $data->get('row/value'), $script);
    $script = str_replace('[row_text]', $data->get('row/text'), $script);
    $data->set('script_row_click', $script);
    /**
     * form
     */
    $form = new PluginWfYml(__DIR__.'/element/form.yml');
    $form->setByTag($data->get());
    $data->set('form', $form->get());
    /**
     * table
     */
    $table = new PluginWfYml(__DIR__.'/element/table.yml');
    $table->setByTag($data->get());
    $data->set('table', $table->get());
    /**
     * widget data
     */
    $widget->setByTag($data->get());
    /**
     *
     */
    wfDocument::renderElement($widget);
  }
}
function PluginFormSelectsearchajax(){
  this.data = {id: null, text: '', url: ''}
  this.mod = function(data){
    this.data = data;
    var select = document.getElementById(this.data.id);
    if(select == null){
      alert('PluginFormSelectsearchajax says: Element with id '+this.data.id+' is not in dom.');
      return null;
    }
    if(!this.data.text){
      this.data.text = '-';
    }
    /**
     * Link.
     */
     var element = [
      {type: 'a', innerHTML: [
          {type: 'div', innerHTML: [
              {type: 'span', innerHTML: '&raquo;', attribute: {class: 'glyphicon glyphicon-triangle-right', style: 'float:right'}},
              {type: 'span', innerHTML: this.data.text, attribute: {id: 'text_'+this.data.id}}
          ], attribute: {class: 'alert alert-secondary', style: 'padding:10px;height:40px'}}
      ], attribute: {href: '#', onclick: "PluginFormSelectsearchajax.click();return false;"}}
    ];
    PluginWfDom.render(element, document.getElementById('div_'+this.data.id));
    /**
     * Hide current select.
     */
     select.style.display='none';
  }
  this.click = function(){
    $('#modal_'+this.data.id).modal('show');
    if(this.data.url){
      this.run_url(this.data.url);
    }else{
      var table = $('#modal_table_'+this.data.id).DataTable();
      table.clear().draw();
    }
  }
  this.submit = function(){
    var form_action = document.getElementById('modal_form_'+this.data.id).getAttribute('action');
    if(form_action.indexOf('?')){
      form_action = form_action.substr(0, form_action.indexOf('?'))+'?';
    }else{
      form_action += '?';
    }
    var elements = $('#modal_form_'+this.data.id).find("input");
    for(var i=0; i<elements.length; i++){
      if(elements[i].getAttribute('type')=='checkbox'){
        if(elements[i].checked){
          form_action += elements[i].getAttribute('name')+'=on&'
        }else{
          form_action += elements[i].getAttribute('name')+'=&'
        }
      }else{
        form_action += elements[i].getAttribute('name')+'='+elements[i].value+'&'
      }
    }
    this.run_url(form_action);    
  }
  this.run_url = function(url){
    var table = $('#modal_table_'+this.data.id).DataTable();
    table.ajax.url(url);
    table.ajax.reload();
  }
}
var PluginFormSelectsearchajax = new PluginFormSelectsearchajax();

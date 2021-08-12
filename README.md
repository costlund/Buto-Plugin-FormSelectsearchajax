# Buto-Plugin-FormSelectsearchajax
Use this plugin as an option to a large selectbox element.
A modal with search form and a datatable with ajax request in this solution.

## Widget include
Include script widget in the head tag.
```
type: widget
data:
  plugin: form/selectsearchajax
  method: include
```

## Widget select
Include modal widget in the body tag. This has to be done for each list.
```
type: widget
data:
  plugin: form/selectsearchajax
  method: select
  data:
```
Id of input element.
```
    id: _my_input_element_id_
```
Url where to get data.
Check out method set_table_data in plugin datatable/datatable_1_10_18 how to render json.
```
    url: '/path_to/json'
```
Add params if needed.
```
    url: '/path_to/json?sw=_any_value_'
```
Fields.
```
    field:
      name: Name
      city: City
```
Row click settings tells what data to handle. Param value will be added to input element. Param text only form visible purpose.
```
    row:
      value: id
      text: name
```
As an option one could set own form data.
This is the default data from /element/form_input.yml which can be modified.
```
    form_input:
      -
        type: div
        attribute:
          class: form-group col-sm-4
        innerHTML:
          -
            type: input
            attribute:
              name: sw
              class: form-control
      -
        type: div
        attribute:
          class: form-group col-sm-4
        innerHTML:
          -
            type: button
            innerHTML: Search
            attribute:
              onclick: PluginFormSelectsearchajax.submit(this);return false;
              class: btn btn-primary
```
Hide form.
Instead the form an table filter input is used.
```
    form_hide: true
```

## Javascript
How to transform an input element to a clickable span. Param url is optional if one want to load the list on click.
```
data = {};
data.id = '_my_input_element_id_';
data.text = 'Click here to select an option from a table.';
data.url = '/path_to/json';
PluginFormSelectsearchajax.mod(data);
```
Auto click on span.
```
PluginFormSelectsearchajax.click();      
```
When click on form load one could have to wait if the form has an modal also.
Otherwice the modlal could be behind modal of the form.
```
setTimeout(function(){ PluginFormSelectsearchajax.click(); }, 500);      
```

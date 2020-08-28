function newInput(name) {
  let input = document.createElement('input');

  input.id = name;
  input.name = name;
  input.setAttribute('type', 'text');

  input.setType = function(value) {
    this.setAttribute('type', value);
  }

  input.setPlaceholder = function(value) {
    this.setAttribute('placeholder', value);
  }

  input.setValue = function(value) {
    this.setAttribute('value', value);
  }

  input.setForm = function(id) {
    this.setAttribute('form', id);
  }

  return input;
}

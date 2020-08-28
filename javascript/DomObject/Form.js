function newForm(name) {
  let form = dowument.createElement('form');

  form.id = name;

  form.noSubmit = function() {
    this.addEventListener('submit', event => { event.preventDefault(); });
  }

  form.onSubmit = function(callBackFunction) {
    this.setAttribute('onSubmit', callBackFunction);
  }

  form.setEnctype = function() {
    this.setAttribute('enctype', 'multipart/form-data');
  }

  form.createInput = function(name) {
    let input = newInput(name);

    input.setForm(this.id);

    return input;
  }
}

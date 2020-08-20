class Form {
  constructor(formName) {
    this.formName = formName;
    this.inputList = [];
    this.inputNameList = [];
    this.inputValueList = [];

    this.form = document.createElement('form');
    this.form.id = formName;
    this.form.style.display = "none";

    document.body.appendChild(this.form);
  }

  addInput(inputName, inputValue) {
    this.inputNameList.push(inputName);
    this.inputValueList.push(inputValue);

    let input = document.createElement('input');
    input.setAttribute('form', this.formName);
    input.name = inputName;
    input.setAttribute('value', inputValue);
    input.style.display = "none";

    document.body.appendChild(input);

    this.inputList.push(input);
  }

  setOnsubmit(functionName) {
    this.form.setAttribute('onsubmit', functionName);
  }
}

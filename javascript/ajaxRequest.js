function ajaxRequest(action, request, data) {
  if (typeof data === 'undefined') {
    data = new FormData();
  }

  data.append('request', request);

  // (B) AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", action);
  // What to do when server responds
  xhr.onload = function(){
    document.body.innerHTML = this.response;
  };
  xhr.send(data);

  return false;
}

function ajaxSubmit(action, form = '') { //Take form name in parameters
  let data = new FormData();
  let inputs = document.querySelectorAll("[form=" + form + "]");

  inputs.forEach((input, i) => { //Foreach the input array and get the value of all input in the FormData
    data.append(input.name, input.value);
  });

  // (B) AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", action);
  // What to do when server responds
  xhr.onload = function(){
    if (this.response.length < 50) {
      document.getElementById('login_message').innerHTML = this.response;
    }
    else {
      document.body.innerHTML = this.response;
    }
  };
  xhr.send(data);

  return false;
}

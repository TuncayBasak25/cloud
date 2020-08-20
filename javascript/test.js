let testForm = new Form("test_form");


function buttonClick() {
  let data = new FormData();
  let folderName = document.getElementById('new_folder_name').value;
  let folderPath = document.getElementById('new_folder_path').value;

  if (folderPath === '' || folderName === '') {
    console.log("Empty input");
    return false;
  }

  data.append("folder_name", folderName);
  data.append("folder_path", folderPath);

  // (B) AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "actions/new_folder.php");
  // What to do when server responds
  xhr.onload = function(){
    document.getElementById('error').innerHTML = this.response;
  };
  xhr.send(data);

  return false;
}

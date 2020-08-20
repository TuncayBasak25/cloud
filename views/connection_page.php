





<form id="login_form" action="actions/login.php" method="post" onsubmit="return login();"></form>
<input id='login_user_id' form='login_form' type="text" name="user_id" placeholder="Username" required="required">
<input id='login_password' form='login_form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='login_button' form='login_form' type="submit" name="submit_login">LOGIN</button>
<p id="login_message"></p>

<form id="signup_form" action="actions/signup.php" method="post" submit="false" onsubmit="return signup();"></form>
<input id='signup_username' form='signup_form' type="text" name="username" placeholder="Username" required="required" pattern="[A-Za-z0-9]{4,16}" title="A-Z/a-z/0-9 between 4 and 16 characters.">
<input id='signup_email' form='signup_form' type="text" name="email" placeholder="Email" required="required">
<input id='signup_password' form='signup_form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<input id='signup_password_repeat' form='signup_form' type="password" name="password_repeat" placeholder="Repeat Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='signup_button' form='signup_form' type="submit" name="submit_signup">SIGNUP</button>
<p id="signup_message"></p>


<script type="text/javascript">
  document.getElementById('login_form').addEventListener('submit', event => { event.preventDefault(); });
  document.getElementById('signup_form').addEventListener('submit', event => { event.preventDefault(); });

  function login() {
    let data = new FormData();
    let user_id = document.getElementById('login_user_id').value;
    let password = document.getElementById('login_password').value;

    data.append("user_id", user_id);
    data.append("password", password);

    // (B) AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "actions/login.php");
    // What to do when server responds
    xhr.onload = function(){
      document.getElementById('login_message').innerHTML = this.response;
    };
    xhr.send(data);

    return false;
  }

  function signup() {
    let data = new FormData();
    let username = document.getElementById('signup_username').value;
    let email = document.getElementById('signup_email').value;
    let password = document.getElementById('signup_password').value;
    let password_repeat = document.getElementById('signup_password_repeat').value;

    data.append("username", username);
    data.append("email", email);
    data.append("password", password);
    data.append("password_repeat", password_repeat);

    // (B) AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "actions/signup.php");
    // What to do when server responds
    xhr.onload = function(){
      document.getElementById('signup_message').innerHTML = this.response;
    };
    xhr.send(data);

    return false;
  }

</script>

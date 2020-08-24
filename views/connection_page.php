





<form id="login_form" action="actions/login.php" method="post" onsubmit="return ajaxSubmit('actions/login.php', 'login_form');"></form>
<input id='login_user_id' form='login_form' type="text" name="user_id" placeholder="Username or Email" required="required">
<input id='login_password' form='login_form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='login_button' form='login_form' type="submit" name="submit_login">LOGIN</button>
<p id="login_message"></p>

<form id="signup_form" action="actions/signup.php" method="post" submit="false" onsubmit="return ajaxSubmit('actions/signup.php' ,'signup_form');"></form>
<input id='signup_username' form='signup_form' type="text" name="username" placeholder="Username" required="required" pattern="[A-Za-z0-9]{4,16}" title="A-Z/a-z/0-9 between 4 and 16 characters.">
<input id='signup_email' form='signup_form' type="text" name="email" placeholder="Email" required="required">
<input id='signup_password' form='signup_form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<input id='signup_password_repeat' form='signup_form' type="password" name="password_repeat" placeholder="Repeat Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='signup_button' form='signup_form' type="submit" name="submit_signup">SIGNUP</button>
<p id="signup_message"></p>

<script type="text/javascript" src="javascript/login_page.js">

</script>

<script type="text/javascript">
  document.getElementById('login_form').addEventListener('submit', event => { event.preventDefault(); });
  document.getElementById('signup_form').addEventListener('submit', event => { event.preventDefault(); });
</script>







<form id="login-form" action="actions/login.php" method="post"></form>
<input id='login-username' form='login-form' type="text" name="log_user_name" placeholder="Username" required="required" pattern="[A-Za-z0-9]{4,16}" title="A-Z/a-z/0-9 between 4 and 16 characters.">
<input id='login-password' form='login-form' type="password" name="log_user_password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='login-button' form='login-form' type="submit" name="submit_login">LOGIN</button>

<form id="signup-form" action="actions/signup.php" method="post"></form>
<input id='signup-username' form='signup-form' type="text" name="new_user_name" placeholder="Username" required="required" pattern="[A-Za-z0-9]{4,16}" title="A-Z/a-z/0-9 between 4 and 16 characters.">
<input id='signup-password' form='signup-form' type="password" name="new_user_password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<input id='signup-password-repeat' form='signup-form' type="password" name="new_password_repeat" placeholder="Repeat Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='signup-button' form='signup-form' type="submit" name="submit_signup">SIGNUP</button>

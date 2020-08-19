





<form id="login-form" action="actions/login.php" method="post"></form>
<input id='login-username' form='login-form' type="text" name="user_id" placeholder="Username" required="required">
<input id='login-password' form='login-form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='login-button' form='login-form' type="submit" name="submit_login">LOGIN</button>

<form id="signup-form" action="actions/signup.php" method="post"></form>
<input id='signup-username' form='signup-form' type="text" name="username" placeholder="Username" required="required" pattern="[A-Za-z0-9]{4,16}" title="A-Z/a-z/0-9 between 4 and 16 characters.">
<input id='signup-email' form='signup-form' type="text" name="email" placeholder="Email" required="required">
<input id='signup-password' form='signup-form' type="password" name="password" placeholder="Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<input id='signup-password-repeat' form='signup-form' type="password" name="password_repeat" placeholder="Repeat Password" required="required" pattern=".{8,}" title="Eight or more characters.">
<button id='signup-button' form='signup-form' type="submit" name="submit_signup">SIGNUP</button>

<form id="logout-form" action="actions/logout.php" method="post">
  <input type="submit" name="logout" value="logout">
</form>

<form id="new-folder-form" action="actions/new_folder.php" method="post">
  <input id='folder-name' form='new-folder-form' type="text" name="folder_name" placeholder="Folder name" required="required">
  <input id='folder-path' form='new-folder-form' type="text" name="folder_path" placeholder="Folder path" required="required">
  <input type="submit" name="new_folder" value="New folder">
</form>

<form id="new-file-form" action="actions/new_file.php" method="post" enctype="multipart/form-data">
  <input id='file-name' form='new-file-form' type="text" name="file_name" placeholder="File name" required="required">
  <input id='file-path' form='new-file-form' type="text" name="file_path" placeholder="File path" required="required">
  <input type="file" name="file" placeholder="Upload a file" required="required">
  <input type="submit" name="new_file" value="New file">
</form>

<form id="delete-content-form" action="actions/delete_content.php" method="post">
  <input id='content-name' form='delete-content-form' type="text" name="content_name" placeholder="content name" required="required">
  <input id='content-path' form='delete-content-form' type="text" name="content_path" placeholder="content path" required="required">
  <input type="submit" name="delete_content" value="Delete content">
</form>

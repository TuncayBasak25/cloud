class LoginView
{
  static display()
  {
    let title = document.createElement('h1');
    title.appendChild(document.createTextNode('FILES EXPLORER'));
    title.style.textAlign = "center";
    document.body.appendChild(title);

    if (typeof contents !== 'undefined') {
      var table = document.createElement('div');

      table.style.width = window.innerWidth + 'px';
      table.style.backgroundColor = 'cyan';

      table.style.display = 'flex';
      table.style.flexWrap = 'wrap';

      document.body.appendChild(table);

      contents.forEach(function(content) {
        content.div = document.createElement('div');
        content.div.style.width = window.innerWidth/4 + 'px';
        content.div.style.height = window.innerWidth/4 + 'px';
        content.div.style.display = 'flex';

        if (content.type === 'folder') {
          content.div.style.backgroundColor = 'yellow';
        }
        else {
          content.div.img = document.createElement('img');
          content.div.img.src = 'uploads/' + content.name;
          content.div.img.style.width = 'inherit';
          content.div.img.style.height = 'inherit';
          content.div.img.style.objectFit = 'cover';
          content.div.appendChild(content.div.img);
        }
        table.appendChild(content.div);
      });

      function loop() {

        table.style.width = window.innerWidth + 'px';

        contents.forEach(function(content) {
          content.div.style.width = window.innerWidth/4 + 'px';
          content.div.style.height = window.innerWidth/4 + 'px';

          if (content.type !== 'folder') {
            content.div.img.style.width = 'inherit';
            content.div.img.style.height = 'inherit';
          }
        });

        window.requestAnimationFrame(loop);
      }
      window.requestAnimationFrame(loop);
    }


    //LOGIN page
    let loginUsername = document.getElementById('login_user_id');
    let loginPassword = document.getElementById('login_password');
    let loginButton = document.getElementById('login_button');

    let loginDiv = document.createElement('div');
    loginDiv.style.width = '220px';
    loginDiv.style.marginLeft = 'auto';
    loginDiv.style.marginRight = 'auto';
    loginDiv.style.marginTop = window.innerHeight/8 + 'px';

    document.body.appendChild(loginDiv);

    loginUsername.style.display = 'block';
    loginUsername.style.marginLeft = 'auto';
    loginUsername.style.marginRight = 'auto';

    loginPassword.style.display = 'block';
    loginPassword.style.marginLeft = 'auto';
    loginPassword.style.marginRight = 'auto';

    loginButton.style.display = 'block';
    loginButton.style.marginLeft = 'auto';
    loginButton.style.marginRight = 'auto';

    loginDiv.appendChild(loginUsername);
    loginDiv.appendChild(loginPassword);
    loginDiv.appendChild(loginButton);

    if (typeof loginMessage !== 'undefined') {
      let message = document.createElement('p');
      message.style.width = 'inherit';
      message.style.textAlign = 'center';
      message.appendChild(document.createTextNode(loginMessage));
      loginDiv.appendChild(message);
    }


    let signupUsername = document.getElementById('signup_username');
    let signupEmail = document.getElementById('signup_email');
    let signupPassword = document.getElementById('signup_password');
    let signupPasswordRepeat = document.getElementById('signup_password_repeat');
    let signupButton = document.getElementById('signup_button');

    let signupDiv = document.createElement('div');
    signupDiv.style.width = '220px';
    signupDiv.style.marginLeft = 'auto';
    signupDiv.style.marginRight = 'auto';
    signupDiv.style.marginTop = window.innerHeight/16 + 'px';

    document.body.appendChild(signupDiv);

    signupUsername.style.display = 'block';
    signupUsername.style.marginLeft = 'auto';
    signupUsername.style.marginRight = 'auto';

    signupEmail.style.display = 'block';
    signupEmail.style.marginLeft = 'auto';
    signupEmail.style.marginRight = 'auto';

    signupPassword.style.display = 'block';
    signupPassword.style.marginLeft = 'auto';
    signupPassword.style.marginRight = 'auto';

    signupPasswordRepeat.style.display = 'block';
    signupPasswordRepeat.style.marginLeft = 'auto';
    signupPasswordRepeat.style.marginRight = 'auto';

    signupButton.style.display = 'block';
    signupButton.style.marginLeft = 'auto';
    signupButton.style.marginRight = 'auto';

    signupDiv.appendChild(signupUsername);
    signupEmail.remove();
    signupDiv.appendChild(signupEmail);
    signupDiv.appendChild(signupPassword);
    signupDiv.appendChild(signupPasswordRepeat);
    signupDiv.appendChild(signupButton);

    document.getElementById('login_form').addEventListener('submit', event => { event.preventDefault(); });
    document.getElementById('signup_form').addEventListener('submit', event => { event.preventDefault(); });
  }
}

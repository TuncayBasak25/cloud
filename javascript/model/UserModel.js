class UserModel
{
  constructor() {

  }

  signup(username, email, password, password_repeat) {
    let data = request('signup');

    data.append('username', username);
    data.append('email', email);
    data.append('password', password);
    data.append('password_repeat', password_repeat);

    ajax(data, this.signupRespone);
  }

  signupRespone() {
    console.log(this.response);
  }
}

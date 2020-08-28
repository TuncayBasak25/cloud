class SessionModel
{
  xmlRequest;

  username = false;
  isConnected = false;

  constructor(parent) {
    this.parent = parent;
  }

  logout() {
    ajax(request('logout'), this.logoutResponse, this);
  }

  logoutResponse() {
    console.log(this.response);
    this.that.isConnected = false;
    this.that.username = false;

    LoginView.display();
  }

  login(user_id, password) {
    let data = request('login');
    data.append('user_id', user_id);
    data.append('password', password);

    this.xmlRequest = ajax(data, this.loginResponse, this);
  }

  loginResponse() {
    console.log(this.response);

    if (this.response.charAt(0) === '{') {
      this.that.username = JSON.parse(this.response).username;
      this.that.isConnected = true;

      UserHomeView.display();
    }
  }

  refreshLogin() {
    ajax(request('refresh'), this.refreshResponse, this);
  }

  refreshResponse() {
    console.log(this.response); document.body.innerHTML = this.response;

    if (this.response.charAt(0) !== '{') {
      this.that.username = false;
      this.that.isConnected = false;

      LoginView.display();
    }
  }
}

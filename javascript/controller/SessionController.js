class SessionController
{
  constructor() {
    this.sessionModel = new SessionModel(this);
  }

  logout() {
    this.sessionModel.logout();
  }

  login(user_id, password) {
    this.sessionModel.login(user_id, password);
  }

  refreshLogin() {
    this.sessionModel.refreshLogin();
  }

  setConnectionState(value) {
    let lastValue = this.sessionModel.isConnected;
    this.sessionModel.isConnected = value;

    if (lastValue !== value) {
      if (value === true) {
        this.onLogin();
      }
      else {
        this.onLogout();
      }
    }
  }

  onLogin() {
    //User home
  }

  onLogout() {
    LoginView.display();
  }
}

class SessionController
{
  sessionModel;

  constructor() {
    this.sessionModel = new SessionModel();
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
}

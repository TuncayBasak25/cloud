class MainController
{
  constructor() {
    this.sessionController = new SessionController();
    this.UserController = new UserController();

    this.start();
  }

  start() {
    if (typeof connectedAs !== 'undefined') {
      this.sessionController.sessionModel.username = connectedAs;
      this.sessionController.sessionModel.isConnected = true;

      this.sessionController.refreshLogin();
    }
  }
}

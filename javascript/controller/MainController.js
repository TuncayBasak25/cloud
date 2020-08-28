class MainController
{
  constructor() {
    this.sessionController = new SessionController();
    this.UserController = new UserController();

    this.start();
  }

  start() {
    if (typeof connectedAs !== 'undefined') {
      this.username = connectedAs;
      this.isConnected = true;

      this.sessionController.refreshLogin();
    }
  }
}

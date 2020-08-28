class UserController
{
  constructor() {
    this.model = new UserModel();
  }

  signup(username, email, password, password_repeat) {
    this.model.signup(username, email, password, password_repeat);
  }
}

<?php namespace Test\Controller;

class AuthController extends BaseController {

    public function loginAction($routeParams) {
        if ($this->isAdmin()) {
            return static::redirectTo('/');
        }

        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['username'] === 'admin' && $_POST['password'] === '123') {
                $_SESSION['is_admin'] = true;
                return static::redirectTo('/');
            } else {
                \array_push($messages, ['danger', 'Invalid username or password']);
            }
        }

        $this->render('login.php', [
            'messages' => $messages
        ]);
    }

    public function logoutAction($routeParams) {
        $_SESSION['is_admin'] = false;
        static::redirectTo('/');
    }

}
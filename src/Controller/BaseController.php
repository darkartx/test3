<?php namespace Test\Controller;

abstract class BaseController {
    static private $config = null;

    protected function isAdmin(): bool {
        return !!($_SESSION['is_admin']);
    }

    protected function beforeAction() {        
        session_start();
    }

    public final function handle($action, $routeParams) {
        $this->beforeAction();
        return $this->{$action}($routeParams);
    }

    static public function show404() {
        http_response_code(404);
        echo '404';
    }

    protected function render($view, $args = []) {
        $args = array_merge([
            'is_admin' => $this->isAdmin(),
            'base_url' => static::getRoot(),
            'messages' => [],
        ], $args);

        extract($args, EXTR_SKIP);

        $file = __DIR__ . "/../views/{$view}";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    static public function redirectTo(string $url) {
        $fullUrl = self::getRoot() . $url;        
        header('Location: ' . $fullUrl);
    }

    static public function getConfig() {
        if (is_null(self::$config)) {
            self::$config = (include(__DIR__ . '/../config.php'))['app'];
        }

        return self::$config;
    }

    static public function getRoot() {
        return self::getConfig()['root'];
    }

}
<?php

namespace app\services;

use app\base\App;

/**
 * Class Auth
 * @package app\services
 */
class Auth
{
    /** @var int Неверный логин или пароль */
    const ERROR_PASSWORD_INCORRECT = 1;
    /** @var int Превышен лимит попыток авторизации */
    const ERROR_EXCEEDED_LIMIT_ATTEMPTS = 2;

    /** @var string Название идентификатора сессии SID */
    private $sessionName;
    /** @var string Название идентификатора пользователя в $_SESSION */
    private $userSessionName;
    /** @var string Данные поля email */
    private $email;
    /** @var string Данные поля пароль */
    private $password;
    /** @var string данные кнопки submit_auth */
    private $submit_auth;
    /** @var string Название куки для хранения authKey пользователя */
    private $authKeyName;
    /** @var Db */
    private $db;
    /** @var array Ошибки авторизации */
    private $errors = [];
    /** @var int User Id. По умолчанию - 0, что означает гость. */
    private $userId = 0;

    /**
     * Auth constructor.
     * @param string $sessionName
     * @param string $userSessionName
     * @param string $authKeyName
     */
    public function __construct(string $sessionName, string $userSessionName, string $authKeyName)
    {
        // Инициализируем переменные.
        $this->sessionName = $sessionName;
        $this->userSessionName = $userSessionName;
        $this->authKeyName = $authKeyName;
        $this->db = App::get()->db;

        // Инициализируем сессию с заданными параметрами.
        session_start([
            'name' => $this->sessionName,
            'cookie_lifetime' => 60 * 60 * 24 * 30,
            'cookie_secure' => true,
            'cookie_httponly' => true,
        ]);

        // Инициализируем проверку авторизации пользователя.
        $this->init();
    }

    /**
     * Метод возвращает Id пользователя.
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Возвращаем массив ошибок.
     * @return array
     */
    public function getError()
    {
        return $this->errors;
    }

    /**
     * Метод проверяет введенные пользователем данные на соответсвие,
     * и в случае успеха регистрирует идентификатор пользователя,
     * в противном случае выдает ошибку.
     * @return bool Если аутентификация прошла успешно - true, иначе - false.
     */
    public function authWithForm()
    {
        //Проверяем бала ли заполнена и отправлена форма авторизации.
        if ($this->checkAuthForm()) {
            // Проверка наличия логина и пароля.
            if ($this->checkLogin()) {
                // регистрируем идентификатор пользователя.
                $this->regSessionUser();
                return true;
            }

            // Неверные логин или пароль.
            $this->errors['auth'] = self::ERROR_PASSWORD_INCORRECT;
            return false;
        }

        // Форма не заполнена.
        return false;
    }

    /**
     * Метод инициализирует проверку состояние текущего пользователя: авторизован он в системе или нет.
     */
    private function init()
    {
        // проверяем зарегистрирован ли идентификатор пользователя.
        if (!$this->checkAuth()) {
            // проверяем есть ли кука идентификатора пользователя.
            if ($this->checkCookieUser()) {
                // регистрируем идентификатор пользователя.
                $this->regSessionUser();
            }
        }
    }

    /**
     * Проверяет зарегистрирован ли идентификатор пользователя.
     * @return bool Если зарегистрирован - true, иначе - false.
     */
    private function checkAuth()
    {
        // Получаем значение идентификатора пользователя.
        $userId = $_SESSION[$this->userSessionName];

        // Если идентификатор существует, то получаем id пользователя.
        if ($userId) {
            $this->userId = $userId;
            return true;
        }

        // Идентификатор не существует.
        return false;
    }

    /**
     * Проверяет есть ли кука идентификатора пользователя.
     * @return bool Если да возвращается true, иначе - false.
     */
    private function checkCookieUser()
    {
        if ($authKey = $_COOKIE[$this->authKeyName]) {
            // Проверяем наличие куки в базе данных, если есть получаем id пользователя.
            $sql = 'SELECT p_user_id from ' . DB_P_AUTH_KEYS . ' WHERE auth_key = :auth_key';
            $this->userId = $this->db->queryOne($sql, [':auth_key' => $authKey]);
            return true;
        }

        return false;
    }

    /**
     * Метод регистрирует идентификатор пользователя и куку идентификатора пользователя.
     */
    private function regSessionUser()
    {
        // Регистрируем идентификатор пользоватея.
        $_SESSION[$this->userSessionName] = $this->userId;

        // Получаем IP авторизовавшегося пользователя.
        $userIP = $_SERVER['REMOTE_ADDR'];

        // задаем случайное значение для куки (authKey).
        $authKey = sha1(session_id() . "xRGp8_1HrPq" . time());

        // создаем куку идентификатора пользователя.
        setcookie($this->authKeyName, $authKey,
            time() + 60 * 60 * 24 * 30 * 12,
            '/', $_SERVER['HTTP_HOST'],
            true,
            true
        );

        // добавляем ключ авторизации в базу данных.
        $sql = 'INSERT INTO ' . DB_P_AUTH_KEYS . ' (auth_key, p_user_id) VALUES (:auth_key, :p_user_id)';
        $this->db->execute($sql, [':auth_key' => $authKey, ':p_user_id' => $this->userId]);

        // добавляем информацию об авторизации пользователя (id и ip пользователя, время авторизации) в базу данных.
        $sql = 'INSERT INTO ' . DB_P_AUTH_LOGS . ' (p_user_id, p_user_ip, created_at) VALUES (:p_user_id, :p_user_ip, NOW())';
        $this->db->execute($sql, [':p_user_id' => $this->userId, ':p_user_ip' => $userIP]);
    }

    /**
     * Метод роверяет заполнена ли и отправлена форма авторизации.
     * @return bool Если форма заполнена и отправлена - true, иначе - false.
     */
    private function checkAuthForm()
    {
        $this->email = trim($_POST['auth']['email']) ?? '';
        $this->password = trim($_POST['auth']['password']) ?? '';
        $this->submit_auth = trim($_POST['auth']['submit_auth']) ?? '';

        // проверяем бала ли заполнена и отправлена форма авторизации.
        if (!empty($this->submit_auth) && !empty($this->email) && !empty($this->password)) {
            return true;
        }

        return false;
    }

    /**
     * Метод проверяет соответствие введенных логина и пороля. Если алгоритм хэширования пароля устарел,
     * то создадим новых hash и сохраним его.
     * @return bool Если логин и пароль соответствуют - true, иначе - false.
     */
    private function checkLogin()
    {
        // Проверяем наличие email в базе данных, если есть получаем хеш пароля.
        $sql = 'SELECT password_hash, id FROM ' . DB_P_USERS . ' WHERE email = :email and status != 0';
        $result = $this->db->queryOne($sql, [':email' => $this->email]);
        $password_hash = $result['password_hash'];
        $userId = $result['id'];

        if ($password_hash) {
            // Проверка пароля.
            if (password_verify($this->password, $password_hash)) {
                // Проверяем, не нужно ли использовать более новый алгоритм.
                if (password_needs_rehash($password_hash, PASSWORD_DEFAULT)) {
                    // Если да, перехешируем и сохраняем новый хеш в базе.
                    $newHash = password_hash($this->password, PASSWORD_DEFAULT);
                    $sql = 'UPDATE ' . DB_P_USERS . ' SET password_hash = :password_hash WHERE id = :id';
                    $this->db->execute($sql, [':password_hash' => $newHash, ':id' => $userId]);
                }

                // Получаем id пользователя.
                $this->userId = $userId;

                // Логин и пароль совпадают.
                return true;
            }
        }

        // Логин или пароль НЕ совпадают.
        return false;
    }

    public function logOut()
    {
        // Получаем ключ идентификатора пользователя.
        $authKey = $_COOKIE[$this->authKeyName];

        // Удаляем все данные сессии.
        $_SESSION = [];

        // Удаляем сессионную cookie и данные о ней из базы данных.
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), session_id(),
                time() - 3600,
                '/',
                $_SERVER['HTTP_HOST'],
                true,
                true
            );
        }

        // Удаляем ключ авторизации из базы данных.
        $sql = 'DELETE FROM ' . DB_P_AUTH_KEYS . ' WHERE auth_key = :auth_key';
        $this->db->execute($sql, [':auth_key' => $authKey]);

        // Удаляем куку идентификатора пользователя.
        setcookie($this->authKeyName, $authKey,
            time() - 3600,
            '/', $_SERVER['HTTP_HOST'],
            true,
            true
        );

        // Уничтожаем сессию.
        session_destroy();
    }
}

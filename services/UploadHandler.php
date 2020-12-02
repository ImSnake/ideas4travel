<?php

namespace app\services;

class UploadHandler
{
    protected $options;
    protected $upload_dir;
    protected $upload_url;
    protected $patch;
    protected $send_response;

    // PHP File Upload error message codes:
    // http://php.net/manual/en/features.file-upload.errors.php
    protected $error_messages = [
        1 => 'размер файла больше допустимого для загрузки',
        2 => 'размер файла больше допустимого для загрузки',
        3 => 'загружена только часть файла',
        4 => 'не выбран файл для загрузки',
        6 => 'отсутствует временная папка для загрузки файла',
        7 => 'не удалось записать файл на диск',
        8 => 'PHP-расширение остановило загрузку файла',
        'accept_file_types' => 'не разрешенный тип файла',
        'max_file_size' => 'файл слишком большой',
        'min_file_size' => 'файл слишком меленький',
        'max_number_of_files' => 'превышено максимальное количество загружаемых файлов',
        'max_width' => 'превышена максимальная ширина картинки',
        'min_width' => 'слишком маленькая ширина картинки',
        'max_height' => 'превышена максимальная высота картинки',
        'min_height' => 'слишком маленькая высота картинки',
        'missingFileName' => 'отсутствует имя файла',
        'errorUpload' => 'ошибка загрузки файла',
        'errorCreateImage' => 'ошибка преобразования файла',
        'errorDelete' => 'ошибка удаления файла'
    ];

    function __construct($patch, $options_user = null, $initialize = true)
    {
        $this->options = array(

            // директория для загрузки файла
            'upload_dir' => 'upload/images/',
            // определяем полный (абсолютный) путь к директории загрузки
            'upload_url' => 'http://' . $_SERVER['SERVER_NAME'] . '/upload/images/',
            // имя файла, которое мы получаем
            'param_name' => 'files',
            // Если обрабатывается как AJAX запрос, то true
            'ajax' => null,
            // эта опция для вывода заголовков
            'access_control_allow_origin' => '*',
            // определяем допустимые расширения файлов
            'accept_file_types' => '/[0-9]+\.(?:jp(?:e?g|e|2)|gif|png|pdf)$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => 20000000,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => 1, // null
            // Image resolution restrictions: 8388608
            'max_width' => 1024,
            'max_height' => 1024,
            'min_width' => 1,
            'min_height' => 1,
            'jpeg_quality' => 100,
            'change' => 'max'
        );

        // рекурсивно заменяем элементы опций по умолчанию, полученными опциями
        if ($options_user) {
            $this->options = array_replace_recursive($this->options, $options_user);
        }

        // опредяем относительный путь
        $this->patch = $patch;

        // инициализируем методы
        if ($initialize) {
            $this->initialize();
        }
    }

    /**********************************************************
     * Функция возвращает все опции
     **********************************************************/
    public function get_options()
    {
        return $this->options;
    }

    /**********************************************************
     * Функция возвращает правильный результаты для файлов
     * размером больше 2ГБ
     **********************************************************/
    protected function fix_integer_overflow($size)
    {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }

    /**********************************************************
     * Функция определяет корректный размер файла
     **********************************************************/
    protected function get_file_size($file_path)
    {
        return $this->fix_integer_overflow(filesize($file_path));
    }


    /**********************************************************
     * Функция сопоставляет полученные ошибки с ключами ошибок
     * заданными в опциях
     **********************************************************/
    protected function get_error_message($error)
    {
        return array_key_exists($error, $this->error_messages) ? $this->error_messages[$error] : $error;
    }

    /**********************************************************
     * Функция выполняет проверку загружаемых файлов
     **********************************************************/
    protected function validate($uploaded_file, $file, $error)
    {
        // проверяем наличия имени у файла
        if (!$file['name']) {
            $file['error'] = $this->get_error_message('missingFileName');
        }
        // проверяем соответствие расширения файла, допустимым расширениям
        if (!preg_match($this->options['accept_file_types'], $file['name'])) {
            $file['error'] = $this->get_error_message('accept_file_types');
        }
        // проверяем максимальный размер файла
        if ($this->options['max_file_size'] && $file['size'] > $this->options['max_file_size']) {
            $file['error'] = $this->get_error_message('max_file_size');
        }
        // проверяем минимальный размер файла
        if ($this->options['min_file_size'] && $file['size'] < $this->options['min_file_size']) {
            $file['error'] = $this->get_error_message('min_file_size');
        }
        if (mb_strtolower(substr(strrchr($file['name'], "."), 1)) !== 'pdf') {
            // получаем значение ширины и высоты исходного изображения
            list($img_width, $img_height) = @getimagesize($uploaded_file);
            // проверяем минимальное значение width
            if ($img_width < $this->options['min_width']) {
                $file['error'] = $this->get_error_message('min_width');
            }
            // проверяем минимальное значение height
            if ($img_height < $this->options['min_height']) {
                $file['error'] = $this->get_error_message('min_height');
            }
        }
        // возвращаем массив ошибок
        return $file['error'];
    }

    /**********************************************************
     * Функция возвращает измененное и безопасное название файла
     **********************************************************/
    protected function trim_file_name($name)
    {
        // удаляет информацию о пути и расширении файла, предотвращает загрузку в
        // другую директорию или замену скрытых системных файлов. Так же удаляет
        // контрольные характеристики и пространство (\x00..\x20) вокруг имени файла
        $file_name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // определяем расширение и даем новое название файлу
        $file_ext = substr(strrchr($file_name, "."), 1);
        // если загружается файл без названия или расширения, например: .htaccess
        // то мы формируем ему несуществующее расширения, что бы не прошло проверку
        if (!$file_ext) {
            $file_ext = 'xxxx';
        }
        // Создаем новое имя файла из временной метки и случайного числа
        $file_name = time() . mt_rand(111, 999) . "." . $file_ext;
        // возвращаем измененное название файла
        return $file_name;
    }

    /**********************************************************
     * Функция возвращает массив данных о заргруженных файлах:
     * название, тип файла, размер, путь к файлу, ошибки и т.д.
     * Если существует опция ajax, то преобразуем массив в
     * json массив и добавляем заголовки
     **********************************************************/
    public function generate_response($content)
    {
        if ($this->options['ajax']) {

            /*function json_fix_cyr($var)
            {
                if (is_array($var)) {
                    $new = array();
                    foreach ($var as $k => $v) {
                        $new[json_fix_cyr($k)] = json_fix_cyr($v);
                    }
                    $var = $new;
                } elseif (is_object($var)) {
                    $vars = get_object_vars($var);
                    foreach ($vars as $m => $v) {
                        $var->$m = json_fix_cyr($v);
                    }
                } elseif (is_string($var)) {
                    $var = iconv('cp1251', 'utf-8', $var);
                }
                return $var;
            }*/
//            $json = json_encode(json_fix_cyr($content), JSON_FORCE_OBJECT);
            $json = json_encode($content, JSON_FORCE_OBJECT);
            $this->head();
            echo $json;
        }
        return $content;
    }

    /**********************************************************
     * функция возвращает массив данных о заргруженных файлах
     **********************************************************/
    public function send_response()
    {
        return $this->send_response;
    }


    /**********************************************************
     * Функция выводит заголовки
     **********************************************************/
    public function head()
    {
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        if ($this->options['access_control_allow_origin']) {
            header('Access-Control-Allow-Origin: ' . $this->options['access_control_allow_origin']);
            header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
            header('Access-Control-Allow-Headers: X-File-Name, X-File-Type');
        }
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
    }

    /**********************************************************
     * Функция получает загружаемый файл и данные по нему из
     * $_FILES, выполняет проверку и в случае успеха перемещает
     * файл в директорию назначения. Функция возвращает инфор-
     * мацию по загружаемому файлу: name, size, type.
     **********************************************************/
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error)
    {
        // Массив для файла
        $file = Array();
        // если $_FILES передает ошибки, то прекращаем все действия
        // и выводим пустой файл с ошибками
        if ($error) {
            $file['name'] = $name;
            $file['name_source'] = $name;
            $file['size'] = $this->fix_integer_overflow(intval($size));
            $file['type'] = $type;
            $file['url'] = null;
            $file['path'] = null;
            $file['error'] = $this->get_error_message($error);
        } else {
            $file['name'] = $this->trim_file_name($name);
            $file['name_source'] = $name;
            $file['size'] = $this->get_file_size($uploaded_file);
            $file['type'] = $type;
            $file['url'] = $this->options['upload_url'] . $file['name'];
            $file['path'] = $this->options['upload_url'];
            $file['error'] = $this->validate($uploaded_file, $file, $error);
            if ($file['error'] == null) {
                $file_path = $this->patch . $this->options['upload_dir'] . $file['name'];
                // перемещаем загруженный файл
                if (move_uploaded_file($uploaded_file, $file_path)) {
                    // Выполняем действия после загрузки файла
                    if (!$this->action($file, $this->options)) {
                        $file['error'] = $this->get_error_message('errorCreateImage');
                    }
                    // если есть опция image_versions
                    foreach ($this->options['image_versions'] as $version => $options) {
                        // Выполняем действия после загрузки файла
                        if (!$this->action($file, $options)) {
                            $file['error'] = $this->get_error_message('errorCreateImage');
                        }
                    }
                    // если были ошибки преобразования файла, то мы удаляем
                    // исходный файл и все преобразованные файлы
                    if ($file['error']) {
                        if (!$this->delete($file['name'])) {
                            $file['error'] = $this->get_error_message('errorDelete');
                        }
                    }
                } else {
                    $file['error'] = $this->get_error_message('errorUpload');
                }
            }
        }
        return $file;
    }

    /**********************************************************
     * Функция запускает алгоритм загрузки файла
     **********************************************************/
    public function initialize()
    {
        $upload = isset($_FILES[$this->options['param_name']]) ? $_FILES[$this->options['param_name']] : null;
        $info = array();
        if ($upload) {
            if (isset($upload['tmp_name']) && is_array($upload['tmp_name'])) {
                if (count($upload['tmp_name']) <= $this->options['max_number_of_files']) {
                    // если param_name идентифицируется как массив "files[]",
                    // то $_FILES является multi-dimensional массивом:
                    foreach ($upload['tmp_name'] as $index => $value) {
                        $info[] = $this->handle_file_upload(
                            $upload['tmp_name'][$index],
                            $upload['name'][$index],
                            $upload['size'][$index],
                            $upload['type'][$index],
                            $upload['error'][$index]
                        );
                    }
                } else {
                    $file = Array();
                    $file['error'] = $this->get_error_message('max_number_of_files');
                    $info[] = $file;
                }
            } else {
                // если param_name идентифицируется как простой файл "file",
                // то $_FILES является one-dimensional массивом:
                $info[] = $this->handle_file_upload(
                    isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                    isset($upload['name']) ? $upload['name'] : null,
                    isset($upload['size']) ? $upload['size'] : null,
                    isset($upload['type']) ? $upload['type'] : null,
                    isset($upload['error']) ? $upload['error'] : null
                );
            }
        } else {
            $file = Array();
            $file['error'] = $this->get_error_message('errorUpload');
            $info[] = $file;
        }
        // передаем в перемунную информацию о загружаемых файлах
        $this->send_response = $info;
    }

    protected function create_image($file_name, $options)
    {
        // опредляем путь к файлу в директории загрузки
        $file_path = $this->patch . $this->options['upload_dir'] . $file_name;
        if ($this->options['upload_dir'] != $options['upload_dir']) {
            $new_file_path = $this->patch . $options['upload_dir'] . $file_name;;
        } else {
            $new_file_path = $this->patch . $this->options['upload_dir'] . $file_name;
        }
        // получаем значение ширины и высоты исходного изображения
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }

        // определяем способ изменения изображения
        $change = $options['change'];

        // типы преобразований изображения
        if ($change == 'original') {
            $new_width = $img_width;
            $new_height = $img_height;
            $x = 0;
            $y = 0;
        }

        // типы преобразований изображения
        if ($change == 'position') {
            $new_width = $options['max_width'];
            $new_height = $options['max_height'];

            $img_width = $_POST['w'];
            $img_height = $_POST['h'];
            $x = $_POST['x'];
            $y = $_POST['y'];
        }

        // если исходное изображение больше чем заданные в опции max значения,
        // то уменьшаем его до max значений, иначе оставляем прежним
        if ($change == 'max') {
            $scale = min($options['max_width'] / $img_width, $options['max_height'] / $img_height);
            if ($scale >= 1) {
                $new_width = $img_width;
                $new_height = $img_height;
            } else {
                $new_width = $img_width * $scale;
                $new_height = $img_height * $scale;
            }
            $x = 0;
            $y = 0;
        }

        // Точный указанный размер.
        if ($change == 'size') {
            $scale = $options['max_width'] / $options['max_height'];
            $min_wh = min($img_width, $img_height);

            // Горизонтальное
//            if ($img_width > $img_height) {
            if ($img_width / $scale > $img_height) {
                $new_width = $options['max_height'] * $scale;
                $new_height = $options['max_height'];
                $x = ($img_width - $img_height * $scale) / 2;
                $y = 0;
                $img_width = $img_height * $scale;
            } elseif ($img_width / $scale < $img_height) {
                $new_height = $options['max_width'] / $scale;
                $new_width = $options['max_width'];
                $x = 0;
                $y = ($img_height - $img_width / $scale) / 2;
                $img_height = $img_width / $scale;
            } else {
                $new_width = $options['max_width'];
                $new_height = $options['max_height'];
                $x = 0;
                $y = 0;
            }
//            }
        }

        if ($change == 'square') {
            $min_wh = min($img_width, $img_height);

            $new_width = $options['max_width'];
            $new_height = $options['max_height'];

            if ($img_width > $img_height) {
                $x = ($img_width - $min_wh) / 2;
            } else {
                $x = 0;
            }
            $y = 0;
            $img_width = $min_wh;
            $img_height = $min_wh;
        }

        // создаем новое изображение
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                $image_quality = isset($options['jpeg_quality']) ? $options['jpeg_quality'] : 85;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                $image_quality = isset($options['png_quality']) ? $options['png_quality'] : 9;
                break;
            default:
                $src_img = null;
        }
        $success = $src_img && @imagecopyresampled(
                $new_img,
                $src_img,
                0, 0, $x, $y,
                $new_width,
                $new_height,
                $img_width,
                $img_height
            ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    /**********************************************************
     * Функция позволяющая выполнять различные действия после
     * загрузки файла на сервер.
     **********************************************************/
    public function action(
        $file,
        $options
    ) {
        if ($this->create_image($file['name'], $options)) {
            return true;
        } else {
            return false;
        }
    }

    /**********************************************************
     * Функция позволяющая выполнять различные действия после
     * загрузки файла на сервер.
     **********************************************************/
    public function action_create(
        $file_name,
        $options
    ) {
        $file = Array();
        // если есть опция image_versions
        foreach ($this->options['image_versions'] as $version => $options) {
            // Выполняем действия после загрузки файла
            if (!$this->create_image($file_name, $options)) {
                $file['error'] = $this->get_error_message('errorCreateImage');
            } else {
                $file['error'] = null;
                $file['path'] = $this->options['upload_url'];
            }
        }
        $file['name'] = $file_name;
        $info[] = $file;
        // передаем в перемунную информацию о загружаемых файлах
        $this->send_response = $file;
    }

    /**********************************************************
     * Функция удяляет файлы загруженные на сервер.
     **********************************************************/
    public function delete(
        $file_name
    ) {
        // опредляем путь к файлу в директории загрузки
        $file_path = $this->patch . $this->options['upload_dir'] . $file_name;

        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        if ($success) {
            foreach ($this->options['image_versions'] as $version => $options) {
                $file_path = $this->patch . $options['upload_dir'] . $file_name;
                if (is_file($file_path)) {
                    unlink($file_path);
                }
            }
        }
        return $success;
    }
}
<?php 


require_once $ROOT_PATH . '/assets/core/err.php';

$ROOT_PATH=getenv('ROOT_PATH');
if($ROOT_PATH==""){
    echo "Path not set. System terminated";
    exit;
}

class FileUpload {

    private $from;
    private $user_id;

    public function __construct($from, $user_id) {
        $this->from = $from;
        $this->user_id = $user_id;
    }

    public function store_file($file, $key, $path) {
        try {
            global $ROOT_PATH;
            $storage_path = $ROOT_PATH . '/storage' . '/' . $path;

            move_uploaded_file($file[$key]['tmp_name'], $storage_path . '/' . $_FILES[$key]['name']);
            return true;
        } catch (Throwable $e) {
            ErrorHandler::handleException($e, $this->from, $this->user_id);
            return false;
        }
    }


}

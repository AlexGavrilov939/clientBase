<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class addRecord
    extends controller
{

    const UPLOAD__PATH = 'uploads/tmp/';

    public function index()
    {
        $data['content'] = $this->parser()->loadView('addRecord');
        $this->parser()->parse('template', $data);
    }

    public function ajax()
    {
        // A list of permitted file extensions
        $allowed = ['png', 'jpg', 'gif','zip'];
        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error"}';
                die();
            }
            $filename = $this->generateFileName($_FILES['upl']['name']);
            if(move_uploaded_file($_FILES['upl']['tmp_name'], self::UPLOAD__PATH . $filename)){
                echo self::UPLOAD__PATH . $filename;
                die();
            }
        }

        echo '{"status":"error"}';
        exit;
    }

    public function generateFileName($file)
    {
        $fileName = md5(pathinfo($file, PATHINFO_FILENAME) . strtotime('now'));
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        return "{$fileName}.{$fileExt}";
    }

    public function deleteImage($data)
    {
        echo $data;
    }


}
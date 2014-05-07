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

    const UPLOAD__PATH = '../htdocs/uploads/tmp/';

    public function index()
    {
        $data['content'] = $this->parser()->loadView('addRecord');
        $this->parser()->parse('template', $data);
    }

    public function test()
    {
        $data['content'] = $this->parser()->loadView('addRecord');
        $this->parser()->parse('template', $data);
    }

    public function ajax()
    {
            if($this->checkAjaxRequest()) {
                $allowed = ['png', 'jpg', 'gif','zip'];

                if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
                    $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

                    if(!in_array(strtolower($extension), $allowed)){
                        echo '{"status":"error"}';
                        die();
                    }

                    if(move_uploaded_file($_FILES['upl']['tmp_name'], self::UPLOAD__PATH . $_FILES['upl']['name'])){
                        echo '{"status":"success"}';
                        die();
                    }
                }
                echo '{"status":"error"}';
                exit;

            } else {
                $this->get404();
            }
    }

    protected function generateFileName($file)
    {
        $fileName = md5(pathinfo($file, PATHINFO_FILENAME) . strtotime('now'));
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        return "{$fileName}.{$fileExt}";
    }

    public function ajaxSaveOrder()
    {
        if($this->checkAjaxRequest()) {
            self::saveOrder($_POST);
            $this->clearTmpFolder(self::UPLOAD__PATH);
            echo 'success!';

        } else {
            echo 'no ajax';
        }

    }

    protected static function saveOrder($data)
    {
        static $mongoClient;
        if(!isset($mongoClient)) {
            $mongoClient = \system\lib\mongoDB::factory();
        }
        $mongoClient->save('orders', $data);
    }

    public function success()
    {
        $data['content'] = $this->parser()->loadView('success');
        $this->parser()->parse('template', $data);
    }

    protected function clearTmpFolder()
    {
        if($handle = opendir(self::UPLOAD__PATH))
        {
            while(false !== ($file = readdir($handle)))
                if($file != "." && $file != "..") unlink(self::UPLOAD__PATH . $file);
            closedir($handle);
        }
    }



}
<?php
use sys\web\controller;

/**
 * Created by Alex Gavrilov.
 */
class addRecord
    extends controller
{

    const UPLOAD__PATH = '../htdocs/uploads/tmp/';

    public function index()
    {
        $data['content'] = $this->view()->generate('addRecord', [], false);
        $this->view()->generate('template', $data);
    }

    public function addTmpImage()
    {
        if($this->isAjaxRequest()) {
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

        }
    }

    protected function generateFileName($file)
    {
        $fileName = md5(pathinfo($file, PATHINFO_FILENAME) . strtotime('now'));
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        return "{$fileName}.{$fileExt}";
    }

    public function processingOrderPost()
    {
        if($this->isAjaxRequest()) {

            $clientInfo = $_POST['clientInfo'];
            $ordersInfo = $_POST['ordersInfo'];

            $this->model()->processingClient($clientInfo);

            foreach($ordersInfo as $order) {
                if(array_filter($order)) {

                }
                $this->model()->processingOrder($order);
            }

        }

    }

    public function success()
    {
        $data['content'] = $this->view()->generate('success', [], false);
        $this->view()->generate('template', $data);
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
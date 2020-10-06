<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;

/**
 * Upload component
 */
class UploadComponent extends Component
{

    public function uploadFile($folder, $uniqName, $data)
    {
        var_dump($data);
        die();
        $dir = WWW_ROOT . 'files' . DS . $folder;

        $file_tmp_name = $data['tmp_name'];
        $filename = $data['name'];

        if (is_uploaded_file($file_tmp_name)) {
            move_uploaded_file($file_tmp_name, $dir . DS . $uniqName);
        }
    }

    public function uploadPicture($data)
    {
        return $this->upload($data, 'pictures');
    }


    public function upload($data, $type, $id = null)
    {
        $max_files = 1;

        if (count($data) > $max_files) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => 'news', 'action' => 'index']);
        }

        if ($type == 'enrollments' || $type == 'registrations') {
            $type_allowed = ['png', 'jpg', 'jpeg', 'gif', 'pdf'];
        } else if ($type == 'news') {
            $type_allowed = ['doc'];
        } else {
            $type_allowed = ['png', 'jpg', 'jpeg', 'gif'];
        }

        $dir = WWW_ROOT . 'files' . DS . $type;

        if ($id != null) {
            $dir = $dir . DS . $id;
        }

        foreach ($data as $file) {
            list($width, $height) = getimagesize($file['tmp_name']);
            $file_tmp_name = $file['tmp_name'];
            $filename = $file['name'];
            $file_ext = substr(strchr($filename, '.'), 1);
            $uniqFileName = uniqid() . rand(10, 99);

            if (!in_array($file_ext, $type_allowed)) {
                $this->_registry->getController()->Flash->error('Type of file not is allowed');
                return $this->_registry->getController()->redirect(['action' => 'add']);
            }

            if ($file_ext != 'pdf' && $file_ext != 'doc') {
                $uniqFileName .= '.jpg';
                if ($type == 'thumbnail' && $height > 720) {
                    $limit = $height / 720;
                } else if ($type == 'picture' && $height > 720 && $height > $width) {
                    $limit = $height / 720;
                } else if ($type == 'picture' && $width > 720 && $width > $height) {
                    $limit = $width / 720;
                } else {
                    $limit = 1;
                }

                $newHeight = $height / $limit;
                $newWidth = $width / $limit;

                $imagemTrueColor = imagecreatetruecolor($newWidth, $newHeight);
                $white = imagecolorallocate($imagemTrueColor, 255, 255, 255);
                imagefill($imagemTrueColor, 0, 0, $white);

                if ($file_ext == 'png') {
                    $imageTmp = imagecreatefrompng($file['tmp_name']);
                } else if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
                    $imageTmp = imagecreatefromjpeg($file['tmp_name']);
                } else if ($file_ext == 'gif') {
                    $imageTmp = imagecreatefromgif($file['tmp_name']);
                }

                imagecopyresampled($imagemTrueColor, $imageTmp, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                if (!imagejpeg($imagemTrueColor, $dir . DS . $uniqFileName)) {
                    imagedestroy($imagemTrueColor);
                    imagedestroy($imageTmp);
                    $this->_registry->getController()->Flash->error(__('The image coult not be saved. Please, try again.'));
                    return $this->_registry->getController()->redirect(['action' => 'index']);
                }
                imagedestroy($imagemTrueColor);
                imagedestroy($imageTmp);
            } else if (is_uploaded_file($file_tmp_name)) {
                $uniqFileName = $uniqFileName . '.' . $file_ext;
                move_uploaded_file($file_tmp_name, $dir . DS . $uniqFileName);
            } else {
                $this->_registry->getController()->Flash->error(__('The file coult not be saved. Please, try again.'));
                return $this->_registry->getController()->redirect(['action' => 'index']);
            }
        }
        return $uniqFileName;
    }
}

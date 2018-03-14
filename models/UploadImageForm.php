<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-14
 * Time: 上午10:57
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImageForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @return array
     */
    public function upload() {
        if ($this->validate()) {
            $this->imageFile->saveAs('upload/' . $this->imageFile->baseName . $this->imageFile->extension);
            return [
                'code' => 200,
                'message' => 'Upload Successful'
            ];
        } else {
            return [
                'code' => 500,
                'message' => $this->errors
            ];
        }
    }

}
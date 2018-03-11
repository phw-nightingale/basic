<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-8
 * Time: 下午3:09
 */

namespace app\controllers;

use app\models\LoginForm;

class UserController extends BaseActiveController
{
    public $modelClass = 'app\models\User';

    public function actionLogin() {
        $model = new LoginForm();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->login()) {
            return [
                'code' => 200,
                'message' => '登录成功',
                'data' => [
                    'access_token' => $model->getUser()->access_token
                ]
            ];
        }
        return [
            'code' => 500,
            'message' => '登录失败'
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-9
 * Time: 下午7:28
 */

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class BaseActiveController extends ActiveController
{

    public $modelClass = 'app\models\User';

    public $post;
    public $get;
    public $_user;
    public $_userId;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->_user = User::findIdentityByAccessToken(Yii::$app->request->headers->get('Authorization'));
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors(); // TODO: Change the autogenerated stub
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'optional' => ['login']
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ]
        ];

        return $behaviors;
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        parent::beforeAction($action); // TODO: Change the autogenerated stub
        $this->post = Yii::$app->request->post();
        $this->get = Yii::$app->request->get();
        $this->_user = Yii::$app->user->identity;
        $this->_userId = Yii::$app->user->id;
        return $action;
    }

}
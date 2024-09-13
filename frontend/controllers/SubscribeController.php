<?php

namespace frontend\controllers;

use Yii;
use common\models\Subscribe;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

/**
 * AuthorController implements the CRUD actions for Author model.
 */
class SubscribeController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $authorId = $request->post('author_id');
            $userId = Yii::$app->user->id;



            if (Subscribe::subscribe($authorId, $userId)) {
                Yii::$app->session->setFlash('success', 'Подписка успешно оформлена!');
            } else {
                Yii::$app->session->setFlash('error', 'Не получилось оформить подписку.');
            }
        } else {
            throw new BadRequestHttpException('Invalid request type.');
        }

        return $this->redirect(['author/index']);
    }

}

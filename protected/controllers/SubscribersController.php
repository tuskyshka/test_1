<?php

class SubscribersController extends Controller
{

    public $layout = '//layouts/index';

    public function actionIndex(){

        $this->render('index');

    }

    public function actionCreate(){

        $subscriber = new Subscribers();
        $subscriber->email = Yii::app()->request->getParam('email');

        if ($subscriber->validate())
        {
            $subscriber->save();

            if (Yii::app()->request->isAjaxRequest)
                $this->renderJson($subscriber->id);

            Yii::app()->user->setFlash('success', 'Вы подписаны на рассылку');

        }
        else
        {

            if (Yii::app()->request->isAjaxRequest)
                $this->renderJson($subscriber->getErrors(), false);

            $errors = $subscriber->getErrors();

            Yii::app()->user->setFlash('error', $errors['email'][0]);

        }

        $this->redirect('/subscribers');

    }


    public function actionSubscribe($id){

        $subscriber = Subscribers::model()->findByPk($id);

        if ($subscriber!==NULL)
            var_dump($subscriber);

    }

    public function actionUnsubscribe($id){

        $subscriber = Subscribers::model()->findByPk($id);

        if ($subscriber!==NULL)
            $subscriber->unsubscribe();

    }

}
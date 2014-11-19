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

        if (!Yii::app()->request->isAjaxRequest)
            $this->redirect('/admin');

        $subscriber = Subscribers::model()->findByPk($id);

        if ($subscriber === NULL) {

            if (Yii::app()->request->isAjaxRequest)
                $this->renderJson('Subscriber not found', false);
            else
                Yii::app()->user->setFlash('subscribeError', 'Subscriber not found');

        } else {

            if ( $subscriber->subscribe() ) {

                if (Yii::app()->request->isAjaxRequest)
                    $this->renderJson(array('status' => Subscribers::STATUS_SUBSCRIBED, 'link' => '/subscribers/unsubscribe/'.$subscriber->id));
                else
                    Yii::app()->user->setFlash('subscribeSuccess', 'Пользователь '.$subscriber->email.' подписан');

            } else {

                if (Yii::app()->request->isAjaxRequest)
                    $this->renderJson($subscriber->getErrors(), false);
                else
                    Yii::app()->user->setFlash('subscribeError', 'Ошибка подписки пользователя '.$subscriber->email);

            }
        }

        $this->redirect(Yii::app()->user->returnUrl);

    }

    public function actionUnsubscribe($id){

        if (!Yii::app()->request->isAjaxRequest)
            $this->redirect('/admin');

        $subscriber = Subscribers::model()->findByPk($id);

        if ($subscriber === NULL) {

            if (Yii::app()->request->isAjaxRequest)
                $this->renderJson('Subscriber not found', false);
            else
                Yii::app()->user->setFlash('subscribeError', 'Subscriber not found');

        } else {

            if ( $subscriber->unsubscribe() ) {

                if (Yii::app()->request->isAjaxRequest)
                    $this->renderJson(array('status' => Subscribers::STATUS_NOT_SUBSCRIBED, 'link' => '/subscribers/subscribe/'.$subscriber->id));
                else
                    Yii::app()->user->setFlash('subscribeSuccess', 'Пользователь '.$subscriber->email.' отписан');

            } else {

                if (Yii::app()->request->isAjaxRequest)
                    $this->renderJson($subscriber->getErrors(), false);
                else
                    Yii::app()->user->setFlash('subscribeError', 'Ошибка отписки пользователя '.$subscriber->email);

            }
        }

        $this->redirect(Yii::app()->user->returnUrl);
    }

}
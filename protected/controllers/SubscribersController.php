<?php

class SubscribersController extends Controller
{

    public $layout = '//layouts/index';

    public function actionIndex(){

        $this->render('index');

    }


    public function actionCreate(){}


    public function actionSubscribe($id){}
    public function actionUnsubscribe($id){}

}
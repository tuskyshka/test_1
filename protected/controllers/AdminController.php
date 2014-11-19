<?php

class AdminController extends Controller
{

    public $layout = '//layouts/index';

    public function actionIndex(){

        $dataProvider=new CActiveDataProvider('Subscribers');

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));

    }

}
<?php

class Subscribers extends CActiveRecord
{

    const
        STATUS_NOT_SUBSCRIBED = 0,
        STATUS_SUBSCRIBED = 1;

    public function tableName()
    {
        return 'subscribers';
    }

    public function rules()
    {

        return array(

            array('email', 'filter', 'filter' => 'trim'),

            array('id, email', 'safe', 'on' => 'search'),
        );
    }


    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_date',
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'status' => 'Status',
            'created_date' => 'Created Date',
        );
    }

    public function search()
    {

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
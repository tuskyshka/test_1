<?php

class Subscribers extends CActiveRecord
{

    const
        STATUS_NOT_SUBSCRIBED = 0, // Не подписан
        STATUS_SUBSCRIBED = 1; // Подписан

    public function tableName()
    {
        return 'subscribers';
    }

    public function rules()
    {

        return array(

            // Ограничить максимальную длинну до 250 символов
            array('email', 'length', 'max' => 250),

            // Проверить формат email на валидность
            array('email', 'CEmailValidator',
                'allowEmpty' => false,
                'checkMX' => true,
                'message' => 'Неправильный e-mail'),

            // Проверить email на уникальность в таблице подписчиков
            array('email', 'CUniqueValidator',
                'allowEmpty' => false,
                'attributeName' => 'email',
                'caseSensitive' => false,
                'className' => 'Subscribers',
                'message' => 'Такой e-mail уже добавлен'),

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

    public function beforeSave()
    {

        // Если запись новая - поставить статус Подписан
        if ($this->isNewRecord)
            $this->status = self::STATUS_SUBSCRIBED;

        return parent::beforeSave();

    }

    public function subscribe(){

        if ($this->id === null)
            return false;

        $this->status = self::STATUS_SUBSCRIBED;
        return $this->save();

    }

    public function unsubscribe(){

        if ($this->id === null)
            return false;

        $this->status = self::STATUS_NOT_SUBSCRIBED;

        return $this->save();

    }
}
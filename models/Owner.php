<?php

namespace app\models;
use dektrium\user\models\User;

use Yii;

/**
 * This is the model class for table "Owner".
 *
 * @property int $idOwner
 * @property string $Description
 * @property int $idPerson
 * @property int $Status
 *
 * @property Item[] $items
 * @property User $person
 * @property Queue[] $queues
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Owner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'idPerson'], 'required'],
            [['idPerson', 'Status'], 'integer'],
            [['Description'], 'string', 'max' => 50],
            [['idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idPerson' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idOwner' => Yii::t('lg_common', 'Id Owner'),
            'Description' => Yii::t('lg_common', 'Description'),
            'idPerson' => Yii::t('lg_common', 'Id Person'),
            'Status' => Yii::t('lg_common', 'Status'),
        ];
    }
  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        //using View for Items
        return $this->hasMany(VItem::className(), ['idClient' => 'idOwner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(User::className(), ['id' => 'idPerson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueues()
    {
        return $this->hasMany(VQueue::className(), ['idOwner' => 'idOwner']);
    }
  
    public static function findByUser($idUser)
    {
        if (($model = self::findOne(['idPerson' => $idUser, 'Status' => 0])) !== null) {
            return $model;
        }
        else{
          $owner = new Owner();
          $owner -> idPerson = $idUser;
          $owner -> Description = "Owner|client ".$idUser;
          $owner -> save();
          return $owner;
        }
    }
    
    /** 
    * Return Owner Model for loged in user ( from session or from DB)
    */
    public static function getUserOwner()
    {
        $session = Yii::$app->session;  
        if (isset($session['user_owner'])){
          $model = $session['user_owner']; 
        }
        else{
          $model =  self::findByUser(Yii::$app->user->identity->id);
          $session['user_owner'] = $model;
        }
        return $model;
    }
    
  
}

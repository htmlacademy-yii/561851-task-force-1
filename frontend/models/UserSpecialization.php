<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_specialization".
 *
 * @property int $user_id
 * @property int $specialization_id
 */
class UserSpecialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialization_id'], 'required'],
            [['specialization_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'specialization_id' => 'Specialization ID',
        ];
    }
}

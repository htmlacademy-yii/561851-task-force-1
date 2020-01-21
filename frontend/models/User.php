<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $birthday
 * @property int $city_id
 * @property string|null $address
 * @property string|null $avatar
 * @property string|null $description
 * @property string $pass
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messenger
 * @property int|null $push_new_message
 * @property int|null $push_task_actions
 * @property int|null $push_new_review
 * @property int|null $show_only_customer
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Chat[] $author_chats
 * @property Chat[] $consumer_chats
 * @property Opinion[] $author_opinions
 * @property Opinion[] $consumer_opinions
 * @property Reply[] $replies
 * @property Task[] $tasks
 * @property City $city
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'city_id', 'pass'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['city_id', 'push_new_message', 'push_task_actions', 'push_new_review', 'show_only_customer'], 'integer'],
            [['address', 'avatar', 'description'], 'string'],
            [['name', 'email', 'pass'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['skype', 'messenger'], 'string', 'max' => 100],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'city_id' => 'City ID',
            'address' => 'Address',
            'avatar' => 'Avatar',
            'description' => 'Description',
            'pass' => 'Pass',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'messenger' => 'Messenger',
            'push_new_message' => 'Push New Message',
            'push_task_actions' => 'Push Task Actions',
            'push_new_review' => 'Push New Review',
            'show_only_customer' => 'Show Only Customer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorChats()
    {
        return $this->hasMany(Chat::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsumerChats()
    {
        return $this->hasMany(Chat::className(), ['consumer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorOpinions()
    {
        return $this->hasMany(Opinion::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsumerOpinions()
    {
        return $this->hasMany(Opinion::className(), ['consumer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opinion".
 *
 * @property int $id
 * @property int $author_id
 * @property int $consumer_id
 * @property string $description
 * @property int $task_id
 * @property int $rating
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 * @property User $consumer
 * @property Task $task
 */
class Opinion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opinion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'consumer_id', 'description', 'task_id', 'rating'], 'required'],
            [['author_id', 'consumer_id', 'task_id', 'rating'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['consumer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['consumer_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'consumer_id' => 'Consumer ID',
            'description' => 'Description',
            'task_id' => 'Task ID',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsumer()
    {
        return $this->hasOne(User::className(), ['id' => 'consumer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}

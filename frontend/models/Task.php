<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $cost
 * @property string $description
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @property string $status
 * @property string $completion_date
 * @property int $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $author_id
 *
 * @property Attachment[] $attachments
 * @property Opinion[] $opinions
 * @property Reply[] $replies
 * @property User $author
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cost', 'description', 'address', 'lat', 'lng', 'completion_date', 'category_id', 'author_id'], 'required'],
            [['name', 'description', 'address', 'status'], 'string'],
            [['cost', 'category_id', 'author_id'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['completion_date', 'created_at', 'updated_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'cost' => 'Cost',
            'description' => 'Description',
            'address' => 'Address',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'status' => 'Status',
            'completion_date' => 'Completion Date',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinion::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['task_id' => 'id']);
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}

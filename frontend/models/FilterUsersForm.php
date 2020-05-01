<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class FilterUsersForm extends Model
{
    public $performerSpecializations;
    public $performerCurrentlyAvailable;
    public $performerCurrentlyOnline;
    public $performerHaveOpinions;
    public $searchByName;

    const MIN_USER_NAME_LENGTH = 0;
    const MAX_USER_NAME_LENGTH = 24;

    public function getFilteredUsers($users)
    {
        if ($this->performerSpecializations) {
            $performerSpecializationsArray = UserSpecialization::find()->select('user_id')->where(['specialization_id' => $this->performerSpecializations])->all();

            $performerSpecializationIds = [];
            foreach ($performerSpecializationsArray as $id) {
                $performerSpecializationIds[] = $id->user_id;
            }

            $users = $users->andWhere(['in','id', $performerSpecializationIds]);
        }

        if ($this->performerCurrentlyAvailable) {
            $usersAvailable = Reply::find()->select('author_id')->where(['accepted' => true])->all();

            $usersAvailableIds = [];
            foreach ($usersAvailable as $id) {
                $usersAvailableIds[] = $id->author_id;
            }

            $users = $users->andWhere(['not in','id', $usersAvailableIds]);
        }

        if ($this->performerCurrentlyOnline) {
            $users = $users->andWhere('last_activity_at >= DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
        }

        if ($this->performerHaveOpinions) {
            $opinions = Opinion::find()->select('consumer_id')->all();
            $opinionsIds = [];
            foreach ($opinions as $id) {
                if (!in_array($id->consumer_id, $opinionsIds)) {
                    $opinionsIds[] = $id->consumer_id;
                }
            }

            $users = $users->andWhere(['in','id', $opinionsIds]);
        }

        if ($this->searchByName) {
            $users = $users->where(['like', 'name', $this->searchByName]);
        }

        return $users;
    }

    public function rules()
    {
        return [
            [
                'performerSpecializations',
                'exist',
                'targetClass' => app\models\Specialization::class
            ],
            [
                'searchByName',
                'string',
                'length' => [self::MIN_USER_NAME_LENGTH, self::MAX_USER_NAME_LENGTH]
            ],
            [
                'performerCurrentlyAvailable',
                'boolean'
            ],
            [
                'performerCurrentlyOnline',
                'boolean'
            ],
            [
                'performerHaveOpinions',
                'boolean'
            ]
        ];
    }

    public function getCategories()
    {
        $categories = Specialization::find()->all();
        $categoriesForForm = ArrayHelper::map($categories, 'id', 'name');

        return $categoriesForForm;
    }
}

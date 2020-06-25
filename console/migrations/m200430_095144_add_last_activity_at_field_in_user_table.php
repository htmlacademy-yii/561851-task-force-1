<?php

use yii\db\Migration;

/**
 * Class m200430_095144_add_last_activity_at_field_in_user_table
 */
class m200430_095144_add_last_activity_at_field_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'last_activity_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'last_activity_at');
        echo "m200430_095144_add_last_activity_at_field_in_user_table returned back.\n";

        return false;
    }
}

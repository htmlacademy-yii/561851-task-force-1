<?php

use yii\db\Migration;

/**
 * Class m200430_055050_add_accepted_field_in_reply_table
 */
class m200430_055050_add_accepted_field_in_reply_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reply}}', 'accepted', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reply}}', 'accepted');
        echo "m200430_055050_add_accepted_field_in_reply_table returned back.\n";

        return false;
    }
}

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
        echo "m200430_055050_add_accepted_field_in_reply_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200430_055050_add_accepted_field_in_reply_table cannot be reverted.\n";

        return false;
    }
    */
}

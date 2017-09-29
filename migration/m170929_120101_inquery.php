<?php

use yii\db\Schema;

class m170929_120101_inquery extends \yii\db\Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!in_array(Yii::$app->db->tablePrefix.'inquery', $tables))  {
          $this->createTable('{{%inquery}}', [
              'id' => $this->primaryKey(),
              'uid' => $this->integer(11),
              'qdescription' => $this->string(2000)->notNull(),
              'qfile' => $this->string(255),
              'qdate' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
              'adate' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
              'afile' => $this->string(255),
              'adescription' => $this->string(2000)->notNull(),
              'category' => $this->integer(11),
              'created_at' => $this->date(),
              'updated_at' => $this->date(),
              'created_by' => $this->bigInteger(20),
              'updated_by' => $this->bigInteger(20),
              'deleted_by' => $this->bigInteger(20),
              'restored_by' => $this->bigInteger(20),
              'status' => $this->integer(11),
              'FOREIGN KEY ([[category]]) REFERENCES {{%inquery_category}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
              'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
              ], $tableOptions);
                } else {
          echo "\nTable `".Yii::$app->db->tablePrefix."inquery` already exists!\n";
        }
        if (!in_array(Yii::$app->db->tablePrefix.'inquery_category', $tables))  {
            $this->createTable('{{%inquery_category}}', [
                'id' => $this->primaryKey(),
                'catname' => $this->string(255)->notNull(),
                'description' => $this->string(1000),
                'date' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
                'created_by' => $this->bigInteger(20),
                'updated_by' => $this->bigInteger(20),
                'deleted_by' => $this->bigInteger(20),
                'restored_by' => $this->bigInteger(20),
            ], $tableOptions);
        } else {
            echo "\nTable `".Yii::$app->db->tablePrefix."inquery_category` already exists!\n";
        }
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%inquery}}');
        $this->execute('SET foreign_key_checks = 1');

        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%inquery_category}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}

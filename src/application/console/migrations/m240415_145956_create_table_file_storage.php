<?php

use yii\db\Migration;

final class m240415_145956_create_table_file_storage extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\FileStorage::tableName(),
            [
                'id' => $this->primaryKey(11),
                'type' => $this->string(255)->notNull(),
                'format' => $this->string(5)->notNull(),
                'name' => $this->string(255)->unique()->notNull(),
                'dir' => $this->text()->notNull(),
                'entity' => $this->string(255)->notNull(),
                'entity_id' => $this->integer(11)->notNull(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->null(),
                'deleted_at' => $this->dateTime()->null(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \application\common\entities\FileStorage::tableName()
        );
    }
}

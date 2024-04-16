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
                'type' => $this->string(255),
                'format' => $this->string(5),
                'name' => $this->string(255),
                'dir' => $this->text(),
                'entity' => $this->string(255),
                'entity_id' => $this->integer(11),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
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

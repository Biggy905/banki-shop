<?php

use yii\db\Migration;

final class m240415_145936_create_table_photoalbum extends Migration
{
    public function up(): void
    {
        $this->createTable(
            \application\common\entities\PhotoAlbum::tableName(),
            [
                'id' => $this->primaryKey(11),
                'title' => $this->string(255)->notNull(),
                'slug' => $this->string(255)->unique()->notNull(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime()->null(),
                'deleted_at' => $this->dateTime()->null(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable(
            \application\common\entities\PhotoAlbum::tableName()
        );
    }
}

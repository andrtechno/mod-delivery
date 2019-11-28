<?php

namespace panix\mod\delivery\migrations;

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190393_104023_delivery
 */

use panix\engine\db\Migration;
use panix\mod\delivery\models\Subscribers;

class m190393_104023_delivery extends Migration
{

    public function up()
    {
        $this->createTable(Subscribers::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(100)->null(),
            'email' => $this->string(100)->notNull(),
            'switch' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(11)->null(),
        ], $this->tableOptions);

        $this->createIndex('switch', Subscribers::tableName(), 'switch');
    }

    public function down()
    {
        $this->dropTable(Subscribers::tableName());
    }

}

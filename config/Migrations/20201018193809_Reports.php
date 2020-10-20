<?php

use Migrations\AbstractMigration;

class Reports extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $table = $this->table('reports');
        $table->addColumn('delivery_date', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('request_id', 'integer')
            ->addColumn('receiver', 'string', ['limit' => 255])
            ->addColumn('status', 'string', ['limit' => 255])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('request_id', 'requests', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}

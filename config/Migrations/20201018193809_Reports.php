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
        $table->addColumn('report_id', 'string', ['limit' => 25])
            ->addColumn('delivery_date', 'date', ['null' => true])
            ->addColumn('user_id', 'integer')
            ->addColumn('request_id', 'integer')
            ->addColumn('receiver', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('status', 'string', ['limit' => 255, 'null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('request_id', 'requests', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}

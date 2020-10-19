<?php

use Migrations\AbstractMigration;

class Vehicles extends AbstractMigration
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

        $table = $this->table('vehicles');
        $table->addColumn('marca', 'string', ['limit' => 255])
            ->addColumn('placa', 'string', ['limit' => 255])
            ->addColumn('cor', 'string', ['limit' => 255])
            ->addColumn('tipo', 'string', ['limit' => 255])
            ->create();
    }
}

<?php

use Migrations\AbstractMigration;

class Roles extends AbstractMigration
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
        $table = $this->table('roles');
        $table->addColumn('role', 'string', ['limit' => 255])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => true,
            ])
            ->create();

        $builder = $this->getQueryBuilder();
        $builder->insert(['role'])
            ->into('roles')
            ->values([
                'role' => 'user'
            ])
            ->values([
                'role' => 'admin'
            ])
            ->execute();
    }
}

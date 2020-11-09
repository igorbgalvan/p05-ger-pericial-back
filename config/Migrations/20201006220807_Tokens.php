<?php

use Migrations\AbstractMigration;

class Tokens extends AbstractMigration
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

        $table = $this->table('tokens');
        $table->addColumn('user_id', 'integer')
            ->addColumn('token', 'string', ['limit' => 255])
            ->addColumn('expiration', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->create();
    }
}

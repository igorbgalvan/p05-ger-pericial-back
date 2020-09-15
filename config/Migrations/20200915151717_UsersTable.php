<?php
use Migrations\AbstractMigration;

class UsersTable extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('email', 'string', ['limit' => 60])
            ->addColumn('senha', 'string', ['limit' => 255])
            ->create();

        $builder = $this->getQueryBuilder();
        $builder->insert(['email', 'senha'])
            ->into('users')
            ->values([
                'email' => 'admin@admin.com',
                'senha' => '$2y$10$oZ/xwh/94SYKzir76oV9CuTVw.Qi9CwViQCqYh5/MDPvhvzXQKG/i',
            ])
            ->execute();
    }

    
}

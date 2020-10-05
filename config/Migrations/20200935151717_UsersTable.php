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
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('position', 'string', ['limit' => 255])
            ->addColumn('phone', 'string', ['limit' => 11])
            ->addColumn('role_id', 'integer', [
                'default' => '1',
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => true,
            ])
            ->addColumn('confirmation', 'boolean', [
                'default' => '0',
            ])
            ->addColumn('profile_picture', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 60,
            ])
            ->addForeignKey('role_id', 'roles', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->create();

        $builder = $this->getQueryBuilder();
        $builder->insert(['email', 'password', 'name', 'position', 'phone', 'confirmation', 'role_id', 'profile_picture'])
            ->into('users')
            ->values([
                'email' => 'admin@admin.com',
                'name' => 'admin',
                'position' => 'test',
                'phone'=>'9999999999',
                'password' => '$2y$10$oZ/xwh/94SYKzir76oV9CuTVw.Qi9CwViQCqYh5/MDPvhvzXQKG/i',
                'role_id' => '2',
                'confirmation' => "1",
            ])
            ->execute();
    }

    
}

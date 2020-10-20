<?php
use Migrations\AbstractMigration;

class VictimsRequests extends AbstractMigration
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
        $table = $this->table('victims_requests', ['id' => false, 'primary_key' => ['victim_id', 'request_id']]);
        $table->addColumn('victim_id', 'integer')
            ->addColumn('request_id', 'integer')
            ->addForeignKey('victim_id', 'victims', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('request_id', 'requests', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}

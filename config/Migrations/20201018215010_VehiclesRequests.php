<?php
use Migrations\AbstractMigration;

class VehiclesRequests extends AbstractMigration
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
        $table = $this->table('vehicles_requests', ['id' => false, 'primary_key' => ['vehicle_id', 'request_id']]);
        $table->addColumn('vehicle_id', 'integer')
            ->addColumn('request_id', 'integer')
            ->addForeignKey('vehicle_id', 'vehicles', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('request_id', 'requests', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}

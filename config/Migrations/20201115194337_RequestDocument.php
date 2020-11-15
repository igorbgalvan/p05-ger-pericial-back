<?php
use Migrations\AbstractMigration;

class RequestDocument extends AbstractMigration
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
        $table = $this->table('request_documents');
        $table->addColumn('request_id', 'integer')
            ->addColumn('doc_name', 'string', ['limit' => 255])
            ->addForeignKey('request_id', 'requests', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}

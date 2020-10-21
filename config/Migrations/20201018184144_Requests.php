<?php
use Migrations\AbstractMigration;

class Requests extends AbstractMigration
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
        $table = $this->table('requests');
        $table->addColumn('data_documento', 'date', ['null' => true])
        ->addColumn('data_realizacao_pericia', 'date', ['null' => true])
        ->addColumn('data_recebimento', 'date', ['null' => true])
        ->addColumn('tipo_pericia', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('exame_pericia', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('descricao', 'string', ['limit' => 600, 'null' => true])
        ->addColumn('nome_vitima', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('n_documento', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('n_bo', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('n_ip', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('outros_proc', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('escrivao', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('delegacia', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('autoridade_requisitante', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('tipo_logradouro', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('logradouro', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('nmr_logradouro', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('bairro', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('cidade', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('n_laudos_expedidos', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('n_oficio', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('cargo', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('observacoes', 'string', ['limit' => 600, 'null' => true])
        ->create();
    }
}

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VictimsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VictimsTable Test Case
 */
class VictimsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VictimsTable
     */
    public $Victims;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Victims',
        'app.Requests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Victims') ? [] : ['className' => VictimsTable::class];
        $this->Victims = TableRegistry::getTableLocator()->get('Victims', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Victims);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

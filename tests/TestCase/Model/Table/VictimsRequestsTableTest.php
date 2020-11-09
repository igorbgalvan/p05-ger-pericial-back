<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VictimsRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VictimsRequestsTable Test Case
 */
class VictimsRequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VictimsRequestsTable
     */
    public $VictimsRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VictimsRequests',
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
        $config = TableRegistry::getTableLocator()->exists('VictimsRequests') ? [] : ['className' => VictimsRequestsTable::class];
        $this->VictimsRequests = TableRegistry::getTableLocator()->get('VictimsRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VictimsRequests);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

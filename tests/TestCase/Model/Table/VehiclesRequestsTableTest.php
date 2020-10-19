<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VehiclesRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VehiclesRequestsTable Test Case
 */
class VehiclesRequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VehiclesRequestsTable
     */
    public $VehiclesRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VehiclesRequests',
        'app.Vehicles',
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
        $config = TableRegistry::getTableLocator()->exists('VehiclesRequests') ? [] : ['className' => VehiclesRequestsTable::class];
        $this->VehiclesRequests = TableRegistry::getTableLocator()->get('VehiclesRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VehiclesRequests);

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

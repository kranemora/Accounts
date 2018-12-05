<?php
namespace Accounts\Test\TestCase\Model\Table;

use Accounts\Model\Table\UsersGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Accounts\Model\Table\UsersGroupsTable Test Case
 */
class UsersGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Accounts\Model\Table\UsersGroupsTable
     */
    public $UsersGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.accounts.users_groups',
        'plugin.accounts.users',
        'plugin.accounts.groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsersGroups') ? [] : ['className' => UsersGroupsTable::class];
        $this->UsersGroups = TableRegistry::getTableLocator()->get('UsersGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersGroups);

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

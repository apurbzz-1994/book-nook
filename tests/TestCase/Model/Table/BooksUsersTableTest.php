<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BooksUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BooksUsersTable Test Case
 */
class BooksUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BooksUsersTable
     */
    protected $BooksUsers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BooksUsers',
        'app.Books',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BooksUsers') ? [] : ['className' => BooksUsersTable::class];
        $this->BooksUsers = $this->getTableLocator()->get('BooksUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BooksUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BooksUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BooksUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

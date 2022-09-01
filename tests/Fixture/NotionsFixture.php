<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotionsFixture
 */
class NotionsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'sale_price' => 'Lorem ipsum dolor sit amet',
                'books_user_id' => 1,
            ],
        ];
        parent::init();
    }
}

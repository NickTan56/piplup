<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubcategoriesFixture
 */
class SubcategoriesFixture extends TestFixture
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
                'category_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-04-24 01:50:00',
                'modified' => '2025-04-24 01:50:00',
            ],
        ];
        parent::init();
    }
}

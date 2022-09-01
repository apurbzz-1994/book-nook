<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notion Entity
 *
 * @property int $id
 * @property string $description
 * @property string $sale_price
 * @property int $books_user_id
 *
 * @property \App\Model\Entity\BooksUser $books_user
 */
class Notion extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'description' => true,
        'sale_price' => true,
        'books_user_id' => true,
        'books_user' => true,
    ];
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notions Model
 *
 * @property \App\Model\Table\BooksUsersTable&\Cake\ORM\Association\BelongsTo $BooksUsers
 *
 * @method \App\Model\Entity\Notion newEmptyEntity()
 * @method \App\Model\Entity\Notion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Notion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Notion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NotionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('notions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('BooksUsers', [
            'foreignKey' => 'books_user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('description')
            ->maxLength('description', 1024)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('sale_price')
            ->maxLength('sale_price', 128)
            ->requirePresence('sale_price', 'create')
            ->notEmptyString('sale_price');

        $validator
            ->integer('books_user_id')
            ->requirePresence('books_user_id', 'create')
            ->notEmptyString('books_user_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('books_user_id', 'BooksUsers'), ['errorField' => 'books_user_id']);

        return $rules;
    }
}

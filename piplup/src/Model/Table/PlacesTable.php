<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Places Model
 *
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\BelongsTo $Subcategories
 *
 * @method \App\Model\Entity\Place newEmptyEntity()
 * @method \App\Model\Entity\Place newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Place> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Place get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Place findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Place patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Place> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Place|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Place saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Place>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Place>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Place>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Place> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Place>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Place>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Place>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Place> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlacesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('places');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
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
            ->integer('subcategory_id')
            ->notEmptyString('subcategory_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn(['subcategory_id'], 'Subcategories'), ['errorField' => 'subcategory_id']);

        return $rules;
    }
}

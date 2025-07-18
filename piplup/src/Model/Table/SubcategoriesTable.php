<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subcategories Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\PlacesTable&\Cake\ORM\Association\HasMany $Places
 *
 * @method \App\Model\Entity\Subcategory newEmptyEntity()
 * @method \App\Model\Entity\Subcategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Subcategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Subcategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Subcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Subcategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Subcategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Subcategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subcategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subcategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subcategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subcategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subcategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subcategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subcategory> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubcategoriesTable extends Table
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

        $this->setTable('subcategories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Places', [
            'foreignKey' => 'subcategory_id',
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
            ->integer('category_id')
            ->notEmptyString('category_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Places Controller
 *
 * @property \App\Model\Table\PlacesTable $Places
 */
class PlacesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Places->find()
            ->select([
                'Places.id',
                'Places.name',
                'Places.address',
                'Places.description',
                'Subcategories__name' => 'Subcategories.name',
                'Categories__name' => 'Categories.name',
            ])
            ->contain(['Subcategories' => ['Categories']])
            ->leftJoinWith('Subcategories')
            ->leftJoinWith('Subcategories.Categories')
            ->enableAutoFields(true); // Keep all original fields
    
        $places = $this->paginate($query, [
            'sortableFields' => [
                'Places.name',
                'Subcategories__name',
                'Categories__name',
            ]
        ]);

        // Fetch all places with category, subcategory, name, address, and description for the map
        $allPlaces = array_map(function ($place) {
            return [
                'name' => $place->name,
                'address' => $place->address,
                'description' => $place->description,
                'subcategory' => $place->subcategory->name ?? '', // Ensure subcategory is fetched
                'category' => $place->subcategory->category->name ?? '' // Ensure category is fetched
            ];
        }, $query->toArray()); // Use the same query to ensure consistency
    
        $this->set(compact('places', 'allPlaces'));
    }    

    /**
     * View method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $place = $this->Places->get($id, contain: ['Subcategories']);
        $this->set(compact('place'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $place = $this->Places->newEmptyEntity();
        $categoryId = $this->request->getData('category_id') ?? null;
    
        if ($this->request->is('post')) {
            $place = $this->Places->patchEntity($place, $this->request->getData());
            if ($this->Places->save($place)) {
                $this->Flash->success(__('The place has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The place could not be saved. Please, try again.'));
        }
    
        $categories = $this->Places->Subcategories->Categories->find('list')->toArray();
        $subcategories = [];
    
        if ($categoryId) {
            $subcategories = $this->Places->Subcategories->find('list')
                ->where(['category_id' => $categoryId])
                ->toArray();
        }
    
        $this->set(compact('place', 'categories', 'subcategories', 'categoryId'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $place = $this->Places->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $place = $this->Places->patchEntity($place, $this->request->getData());
            if ($this->Places->save($place)) {
                $this->Flash->success(__('The place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The place could not be saved. Please, try again.'));
        }
        $subcategories = $this->Places->Subcategories->find('list', limit: 200)->all();
        $this->set(compact('place', 'subcategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $place = $this->Places->get($id);
        if ($this->Places->delete($place)) {
            $this->Flash->success(__('The place has been deleted.'));
        } else {
            $this->Flash->error(__('The place could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

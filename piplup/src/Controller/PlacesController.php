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
        // Join table to include Categories and Subcategories
        $query = $this->Places->find()
            ->contain(['Subcategories' => ['Categories']])
            ->leftJoinWith('Subcategories')
            ->leftJoinWith('Subcategories.Categories')
            ->enableAutoFields(true);
    
        // Handle search filter from GET
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'Places.name LIKE' => '%' . $search . '%',
                    'Places.address LIKE' => '%' . $search . '%',
                    'Places.description LIKE' => '%' . $search . '%',
                ]
            ]);
        }
    
        // Handle filter by categories and subcategories
        $categoryFilters = $this->request->getQuery('categories');
        $subcategoryFilters = $this->request->getQuery('subcategories');
    
        if (!empty($categoryFilters)) {
            $query->where(['Subcategories.category_id IN' => $categoryFilters]);
        }
    
        if (!empty($subcategoryFilters)) {
            $query->where(['Places.subcategory_id IN' => $subcategoryFilters]);
        }
    
        $places = $this->paginate($query, [
            'sortableFields' => [
                'Places.name',
                'Subcategories.name',
                'Categories.name',
            ],
        ]);
    
        // For the map
        $allPlaces = [];
        foreach ($places as $place) {
            $allPlaces[] = [
                'name' => $place->name,
                'address' => $place->address,
                'description' => $place->description,
                'subcategory' => $place->subcategory->name ?? '',
                'category' => $place->subcategory->category->name ?? '',
            ];
        }
    
        // Fetch for the filter box
        $categories = $this->Places->Subcategories->Categories->find('list')->toArray();
        $subcategories = $this->Places->Subcategories->find('all')
            ->contain(['Categories'])
            ->toArray();
    
        $this->set(compact('places', 'allPlaces', 'categories', 'subcategories'));
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

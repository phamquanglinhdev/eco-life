<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EquipmentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EquipmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EquipmentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Equipment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/equipment');
        CRUD::setEntityNameStrings('Trang thiết bị', 'Các trang thiết bị');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::addColumn([
            'name' => 'bill_id',
            'type'=>'select',
            'label' => 'Số hóa đơn',
            'attribute'=>'code',
            'model'=>'App\Models\Bill',
            'entity'=>'Bill',
        ]);
        CRUD::addColumn(['name' => 'name', 'label' => 'Tên trang thiết bị']);
        CRUD::addColumn(['name' => 'price', 'label' => 'Đơn giá','type'=>'number']);
        CRUD::addColumn(['name' => 'quantity', 'label' => 'Số lượng']);
        CRUD::addColumn(['name' => 'totals', 'label' => 'Tạm tính','type'=>'model_function','function_name'=>'total']);
        CRUD::addColumn(['name' => 'depreciation', 'label' => 'Khấu hao']);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EquipmentRequest::class);
        CRUD::addField([
            'name' => 'bill_id',
            'type'=>'select2',
            'label' => 'Số hóa đơn',
            'attribute'=>'code',
            'model'=>'App\Models\Bill',
            'entity'=>'Bill',
        ]);
        CRUD::addField(['name' => 'name', 'label' => 'Tên trang thiết bị']);
        CRUD::addField(['name' => 'price', 'label' => 'Đơn giá','type'=>'number']);
        CRUD::addField(['name' => 'quantity', 'label' => 'Số lượng']);
        CRUD::addField(['name' => 'depreciation', 'label' => 'Khấu hao']);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

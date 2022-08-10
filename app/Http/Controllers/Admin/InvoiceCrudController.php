<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InvoiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvoiceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Invoice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invoice');
        CRUD::setEntityNameStrings('Thanh toán', 'Bảng thanh toán');
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
            'name' => 'task_id',
            'type' => 'select',
            'entity'=>"Task",
            'label'=>"Thanh toán cho công",
            "model"=>"App\Models\Task",
            'attribute'=>"FullName",
        ]);
        CRUD::column('done')->label("Hình thức")->type("select_from_array")->options(["Thanh toán một phần","Thanh toán xong"]);
        CRUD::column('price')->label("Số tiền thanh toán")->type("number")->suffix(" đ");
        CRUD::column('created_at')->label("Thời gian tạo thanh toán")->type("datetime");

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
        CRUD::setValidation(InvoiceRequest::class);
        CRUD::addField([
            'name' => 'task_id',
            'type' => 'select2',
            'entity'=>"Task",
            'label'=>"Thanh toán cho công",
            "model"=>"App\Models\Task",
            'attribute'=>"FullName",
        ]);
        CRUD::field('done')->label("Hình thức")->type("select_from_array")->options(["Thanh toán một phần","Thanh toán xong"]);
        CRUD::field('price')->label("Số tiền thanh toán")->type("number");
        CRUD::field('created_at')->label("Thời gian thanh toán");
        CRUD::field('verification')->type("image")->crop(true)->label("Bằng chứng thanh toán");


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

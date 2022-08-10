<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RecordRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecordCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Record::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/record');
        CRUD::setEntityNameStrings('Chấm công', 'Danh sách chấm công');
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
            'label'=>"Công cần chấm",
            "model"=>"App\Models\Task",
            'attribute'=>"FullName",
        ]);
        CRUD::column('type')->type("select_from_array")->options(["Theo giờ","Công ngày"])->label("Chấm theo");
        CRUD::column('date')->type("date")->label("Ngày");
        CRUD::column('start')->type("time")->label("Thời gian bắt đầu");
        CRUD::column('end')->type("time")->label("Thời gian kết thúc");
        CRUD::column('price')->label("Tiền công");
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
        CRUD::setValidation(RecordRequest::class);

        CRUD::addField([
            'name' => 'task_id',
            'type' => 'select2',
            'entity'=>"Task",
            'label'=>"Công cần chấm",
            "model"=>"App\Models\Task",
            'attribute'=>"FullName",
            'options'   => (function ($query) {
                return $query->where('type', '1')->get();
            }),
        ]);
        CRUD::field('type')->type("select_from_array")->options(["Theo giờ","Công ngày"])->label("Chấm theo");
        CRUD::field('date')->type("date")->label("Ngày");
        CRUD::field('start')->type("time")->label("Thời gian bắt đầu");
        CRUD::field('end')->type("time")->label("Thời gian kết thúc");
        CRUD::field('price')->label("Tiền công")->type("number");

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TaskCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/task');
        CRUD::setEntityNameStrings('Công', 'Bảng công');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label("Mã công");
        CRUD::column('name')->label("Tên");
        CRUD::column('phone')->label("Số điện thoại");
        CRUD::column('type')->label("Loại công")->type("select_from_array")->options(["Công khoán","Công ngày"]);
        CRUD::column('start')->label("Ngày bắt đầu");
//        CRUD::column('end')->label("Ngày bắt đầu");
//        CRUD::column('price');
        CRUD::column('status')->label("Trạng thái")->type("select_from_array")->options(["Đang mở","Đã đóng"]);

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
        CRUD::setValidation(TaskRequest::class);

        CRUD::field('name')->label("Tên công");
        CRUD::field('phone')->label("Số điện thoại");
        CRUD::field('address')->label("Địa chỉ");
        CRUD::field('type')->label("Loại công")->type("select_from_array")->options(["Công khoán","Công ngày"]);
        CRUD::field('start')->label("Ngày bắt đầu")->type("date");
        CRUD::field('end')->label("Ngày kết thúc")->type("date");;
        CRUD::field('price')->label("Giá khoán")->type("number");;
//        CRUD::field('status')->label("Trạng thái")->type("select_from_array")->options(["Đang mở","Đã đóng"]);;

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReceiptRequest;
use App\Models\Equipment;
use App\Models\Receipt;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class ReceiptCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReceiptCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Receipt::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/receipt');
        CRUD::setEntityNameStrings('Hóa đơn trang thiết bị', 'Các hóa đơn trang thiết bị');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('code')->label("Số hóa đơn");
        CRUD::column('capture')->label("Ảnh chụp hóa đơn")->type("image");
        CRUD::addColumn([
            'name'=>"total",
            'label'=>'Giá trị hóa đơn',
            'type'  => 'model_function',
            'function_name' => 'countTotal',
        ]);
        CRUD::column('updated_at')->label("Thời gian cập nhật");

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
        CRUD::setValidation(ReceiptRequest::class);

        CRUD::field('code')->label("Số hóa đơn");
        CRUD::field('capture')->label("Ảnh chụp hóa đơn")->type("image")->crop(true);
//        CRUD::addField([
//            'name' => 'equipments',
//            'label' => 'Các trang thiết bị',
//            'type' => 'repeatable',
//            'fields' => [
//                [
//                    'name' => 'name',
//                    'type' => 'text',
//                    'label' => 'Tên trang thiết bị',
//                ],
//            ]
//        ]);

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
    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

//    protected function store(Request $request)
//    {
//        $rc = Receipt::create([
//            'code' => $request->code,
//            'capture' => $request->capture,
//            'updated_at' => date("Y-m-d H:i:s"),
//            'price' => $request->price,
//        ]);
//        $equipments = json_decode($request->equipments);
//        foreach ($equipments as $equipment) {
//            Equipment::create([
//                'name' => $equipment->name,
//                'receipt_id' => $rc->id,
//            ]);
////            dd($equipment);
//        }
//        return redirect("admin/receipt");
//    }
//
//    protected function update(Request $request)
//    {
//        Receipt::find($request->id)->update([
//            'code' => $request->code,
//            'capture' => $request->capture,
//            'updated_at' => date("Y-m-d H:i:s"),
//            'price' => $request->price,
//        ]);
//        //insert
//        $equipments = json_decode($request->equipments);
//        foreach ($equipments as $equipment) {
//            if (Equipment::where("name", "=", $equipment->name)->where("receipt_id", "=", $request->id)->where("active", "=", 1)->count() == 0) {
//                Equipment::create([
//                    'name' => $equipment->name,
//                    'receipt_id' => $request->id,
//                ]);
//            }
////            dd($equipment);
//        }
//        //delete
//        $exists = [];
//        foreach ($equipments as $equipment) {
//            $exists[] = $equipment->name;
//        }
//        if (Equipment::where("receipt_id", "=", $request->id)->where("active", "=", 1)->count() > 0) {
//            $olds = Equipment::where("receipt_id", "=", $request->id)->where("active", "=", 1)->get();
//            foreach ($olds as $old) {
//                if (!in_array($old->name, $exists)) {
//                    Equipment::find($old->id)->delete();
//                }
//            }
//        }
//
//        return redirect("admin/receipt");
//    }
}

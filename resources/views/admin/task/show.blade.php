@extends(backpack_view("blank"))
@section("content")
    <div class="container-fluid">
        <div class="py-2">
            <div class="h3">Thông tin bảng công của {{$task->name}}, mã công #{{$task->id}}</div>
        </div>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">Số điện thoại : {{$task->phone}}</a>
            <a href="#" class="list-group-item list-group-item-action">Địa chỉ : {{$task->address}}</a>
            <a href="#" class="list-group-item list-group-item-action">Loại công
                : {{$task->type==0?"Công khoán":"Công ngày"}}</a>
            <a href="#" class="list-group-item list-group-item-action">Ngày bắt đầu : {{$task->start}}</a>
            @if($task->type==0)
                <a href="#" class="list-group-item list-group-item-action">Ngày kết thúc: {{$task->end}}</a>
                <a href="#" class="list-group-item list-group-item-action">Công khoán: {{$task->price}}</a>
            @else
                <a href="#" class="list-group-item list-group-item-action">Tổng số công: {{number_format($task->Count())}} </a>
                <a href="#" class="list-group-item list-group-item-action">Tổng tiền công: {{number_format($task->Total())}} đ</a>
                <a href="#" class="list-group-item list-group-item-action">Đã thanh toán: {{number_format($task->Invoiced())}} đ</a>
                <a href="#" class="list-group-item list-group-item-action">Còn lại: {{number_format($task->Total()-$task->Invoiced())}} đ</a>
                <a href="#" class="list-group-item list-group-item-action">Trạng
                    thái: {{$task->status==0?"Chưa thanh toán xong":"Đã thanh toán"}}</a>

            @endif

        </div>
        <hr>
        @if($task->type==1)
            <div class="py-2">
                <div class="h3">Lịch sử chấm công</div>
            </div>
            <div class="list-group">
                @foreach($task->Records()->orderBy("date","ASC")->get() as $record)
                    <a href="#" class="list-group-item list-group-item-action">
                        Ngày {{\Carbon\Carbon::parse($record->date)->isoFormat("DD-MM-YYYY")}} , {{$record->type==0?"Làm theo giờ từ $record->start đến $record->end":"Làm theo ngày"}}
                        nhận công {{number_format($record->price)}} đ
                    </a>
                @endforeach
            </div>
            <hr>
            <div class="py-2">
                <div class="h3">Lịch sử chấm công</div>
            </div>
            <div class="list-group">
                @foreach($task->Invoices()->orderBy("created_at","ASC")->get() as $invoice)
                    <a href="#" class="list-group-item list-group-item-action">
                        Ngày {{\Carbon\Carbon::parse($invoice->created_at)->isoFormat("DD-MM-YYYY HH:mm:ss")}} , thanh toán {{number_format($invoice->price)}} đ
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

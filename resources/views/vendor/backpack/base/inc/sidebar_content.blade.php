<!-- This file is used to store sidebar items, inside the Backpack admin panel -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
            class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon lab la-elementor"></i>Nhập kho</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('equipment') }}"><i
                    class="nav-icon la la-toolbox"></i> Trang thiết bị</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('material') }}"><i
                    class="nav-icon la la-tree"></i> Nguyên vật liệu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('bill') }}"><i
                    class="nav-icon la la-file-invoice-dollar"></i> Hóa đơn</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon lab la-elementor"></i>Công</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('task') }}"><i class="nav-icon la la-tasks"></i>
                Bảng công</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('record') }}"><i
                    class="nav-icon la la-check"></i> Chấm công</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('invoice') }}"><i
                    class="nav-icon la la-dollar"></i> Thanh toán</a></li>
    </ul>
</li>

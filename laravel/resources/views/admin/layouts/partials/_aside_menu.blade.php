<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div
        id="kt_aside_menu"
        class="aside-menu my-4 "
        data-menu-vertical="1"
        data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <ul class="menu-nav ">
            <li class="menu-item {{ (strpos(\Request::route()->getName(),'admin.province') !== false) ? 'menu-item-active' : ''  }}" aria-haspopup="true">
                <a href="{{route('admin.province')}}" class="menu-link ">
                    <span class="menu-text">
                        Tỉnh/Thành phố
                    </span>
                </a>
            </li>
            <li class="menu-item {{ (strpos(\Request::route()->getName(),'admin.property') !== false) ? 'menu-item-active' : ''  }}" aria-haspopup="true">
                <a href="{{route('admin.property')}}" class="menu-link ">
                    <span class="menu-text">
                        Bất động sản
                    </span>
                </a>
            </li>
            <li class="menu-item {{ (strpos(\Request::route()->getName(),'admin.customer') !== false) ? 'menu-item-active' : ''  }}" aria-haspopup="true">
                <a href="{{route('admin.customer.index')}}" class="menu-link ">
                    <span class="menu-text">
                        Khách hàng
                    </span>
                </a>
            </li>
            <li class="menu-section ">
                <h4 class="menu-text">Hệ thống</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <li class="menu-item {{ (strpos(\Request::route()->getName(),'admin.setting') !== false) ? 'menu-item-active' : ''  }}" aria-haspopup="true">
                <a href="{{route('admin.setting')}}" class="menu-link ">
                    <span class="menu-text">
                        Cài đặt
                    </span>
                </a>
            </li>
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>

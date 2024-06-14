<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item">
                        <a href="{{ url()->previous() }}" class="menu-link">
                            <span class="menu-text"><i class="fas fa-arrow-left text-primary"></i></span>
                        </a>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->

        <!--begin::Topbar-->
        <div class="d-flex justify-content-end align-items-center">
            <!--begin::User-->
            <div class="topbar-item">
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                            <span class="text-muted font-weight-bold font-size-base mr-1">Halo, </span>
                            @if (isset(auth()->user()->name))
                                <span
                                    class="text-dark font-weight-boldest font-size-base mr-3">{{ auth()->user()->name }}</span>
                            @else
                                <span class="text-dark font-weight-boldest font-size-base mr-3">Anonim</span>
                            @endif
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-4 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <h5>Profile</h5>
                        <div class="py-2">
                            <div class="d-flex align-items-start">
                                <div class="d-flex flex-column ">
                                    <h6 class="font-weight-bold text-success">{{ auth()->user()->name }}</h6>
                                    <div class="text-muted">{{ auth()->user()->role->name }}</div>
                                    <div class="text-dark">{{ auth()->user()->email }}</div>
                                    <div class="navi">
                                        <span class="p-0 pb-2">
                                            <span class="navi-icon mr-1">
                                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                fill="#000000" />
                                                            <circle fill="#000000" opacity="0.3" cx="19.5"
                                                                cy="17.5" r="2.5" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text text-primary">{{ auth()->user()->email }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <a href="/dashboard/logout"
                                class="btn btn-sm btn-light-danger font-weight-bolder">Logout</a>
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->

    </div>
    <!--end::Container-->
</div>

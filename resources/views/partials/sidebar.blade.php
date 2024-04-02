<style>
    .reports-collapse.active {
        background-color: #5D87FF;
        color: #fff !important;
    }

    .reports-collapse.active:hover {
        color: #000 !important;
    }
</style>

<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <h2>BFP</h2>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item ">
                    <a class="sidebar-link {{ $active == 'home' ? 'active' : '' }}"
                        href="{{ route(auth()->user()->type . '.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item p-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button sidebar-link" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span> <i class="ti ti-article"></i></span>
                                    <span class="hide-menu">Reports</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                {{-- <a href="{{route('user.nonResponse.index')}}" class="sidebar-link text-decoration-none py-3"> Non Response</a> --}}
                                <a href="{{ route('user.Response.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'response' ? 'active' : '' }}"
                                    href="{{ route(auth()->user()->type . '.dashboard') }}">
                                    Operation
                                </a>
                                <a href="{{ route('user.nonResponse.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse">
                                    Investigation
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                @if (auth()->user()->type == 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-circle"></i>
                            </span>
                            <span class="hide-menu">Accounts</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-cards"></i>
                            </span>
                            <span class="hide-menu">Personnel</span>
                        </a>
                    </li>


                    {{-- Bottom --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu">Logs</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                            <span>
                                <i class="ti ti-typography"></i>
                            </span>
                            <span class="hide-menu">Trash</span>
                        </a>
                    </li>
                @endif

                {{-- Bottom --}}

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

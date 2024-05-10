{{-- <style>
    .reports-collapse.active {
        background-color: #5D87FF;
        color: #fff !important;
    }

    .reports-collapse.active:hover {
        color: #000 !important;
    }
    .divider {
    display: flex;
    align-items: center;
}

.divider::before,
.divider::after {
    content: "";
    flex: 1;
    border-top: 1px solid #000;
}

.divider-text {
    padding: 0 10px;
    color: #000;
    font-weight: bold;
}
</style> --}}

<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
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
                    <a class="sidebar-link" href="{{ route(auth()->user()->type . '.dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard" style="color: #5D87FF"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <hr class="my-2">
                <p class="">REPORTS</p>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('operation.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'operation' ? 'active' : '' }}">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Operation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <div class="accordion accordion-flush" href="{{ route('investigation.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'investigation' ? 'active' : '' }}">
                        <div class="accordion-item p-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed sidebar-link" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span> <i class="ti ti-report"></i></span>
                                    <span class="hide-menu">Investigation</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse {{ ($active == 'investigation' || $active == 'minimal') || ($active == 'spot' || $active == 'progress') || ($active == 'final') ? '' : 'collapse' }}"
                                data-bs-parent="#accordionExample">

                                <a href="{{ route('investigation.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'investigation' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-category"></i>
                                    </span>
                                    All
                                </a>
                                <a href="{{ route('investigation.minimal.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'minimal' ? 'bg-primary text-light' : '' }}"
                                    href="{{ route(auth()->user()->type . '.dashboard') }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Minimal
                                </a>
                                <a href="{{ route('investigation.spot.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'spot' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Spot
                                </a>
                                <a href="{{ route('investigation.progress.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'progress' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Progress
                                </a>
                                <a href="{{ route('investigation.final.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'final' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Final
                                </a>


                                {{-- href="{{route('investigation.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'investigation' ? 'active' : ''}}" href="{{route(auth()->user()->type . '.dashboard')}}" --}}
                            </div>
                        </div>
                    </div>
                </li>

                <hr class="my-2">
                @if (auth()->user()->type === 'admin')
                <p class="">CONFIGURATIONS</p>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.occupancy.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Occupancy</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.barangay.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Barangay</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.alarms.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-bell-school"></i>
                        </span>
                        <span class="hide-menu">Alarm</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.trucks.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-truck"></i>
                        </span>
                        <span class="hide-menu">Trucks</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.rank.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Ranks</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.designation.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Designation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.personnel.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span> <i class="ti ti-users"></i></span>
                        <span class="hide-menu">Personnel</span>
                    </a>
                </li>
                <hr class="my-2">
                <p class="">ACTIVITY</p>

                    <li class="sidebar-item">
                        <div class="accordion accordion-flush"
                            class="sidebar-link accordion-body ms-2 reports-collapse" id="logsAccordion">
                            <div class="accordion-item p-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed sidebar-link" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseLogs" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <span> <i class="ti ti-file-description"></i></span>
                                        <span class="hide-menu">Logs</span>
                                    </button>
                                </h2>
                                <div id="collapseLogs" class="accordion-collapse collapse"
                                    data-bs-parent="#logsAccordion">

                                    <a href="{{ route('admin.logs.operation.viewLogs') }}"
                                        class="sidebar-link accordion-body ms-2 reports-collapse">
                                        <span> <i class="ti ti-caret-right"></i></span>
                                        Operation
                                    </a>
                                    <a href="{{ route('admin.logs.investigation.viewLogs') }}"
                                        class="sidebar-link accordion-body ms-2 reports-collapse">
                                        <span><i class="ti ti-caret-right"></i></span>
                                        Investigation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-item">
                        <div class="accordion accordion-flush"
                            class="sidebar-link accordion-body ms-2 reports-collapse" id="trashAccordion">
                            <div class="accordion-item p-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed sidebar-link" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTrash"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <span> <i class="ti ti-trash"></i></span>
                                        <span class="hide-menu">Trash</span>
                                    </button>
                                </h2>
                                <div id="collapseTrash" class="accordion-collapse collapse"
                                    data-bs-parent="#trashAccordion">
                                    <a href="{{ route('admin.trash.operation.index') }}"
                                        class="sidebar-link accordion-body ms-2 reports-collapse">
                                        <span><i class="ti ti-caret-right"></i></span>
                                        Operation
                                    </a>
                                    <a href="{{ route('admin.trash.investigation.index') }}"
                                        class="sidebar-link accordion-body ms-2 reports-collapse">
                                        <span><i class="ti ti-caret-right"></i></span>
                                        Investigation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                {{-- Bottom --}}

                <hr class="my-2">
                <p class="">ACCOUNT</p>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route(auth()->user()->type . '.account.admin') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Admin</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route(auth()->user()->type . '.account.user') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">User</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

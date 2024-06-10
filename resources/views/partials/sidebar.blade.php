<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
                <h2
                    style="background-image: linear-gradient(to right, #0b063f, #0f5fd6); -webkit-background-clip: text; background-clip: text; color: transparent;">
                    <b>BFP-Ligao City</b>
                </h2>

            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route(auth()->user()->type . '.dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard" style="color: #7e88a6"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if ($user->privilege == 'admin_clerk')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.personnel.index') }}"
                            class="sidebar-link accordion-body ms-2 reports-collapse">
                            <span> <i class="ti ti-users"></i></span>
                            <span class="hide-menu">Personnel</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.personnel.search.index') }}"
                        class="sidebar-link accordion-body ms-2 reports-collapse">
                        <span> <i class="ti ti-users"></i></span>
                        <span class="hide-menu">Personnel Search</span>
                    </a>
                </li>
                <hr class="my-2">
                {{-- @if (auth()->user()->privilege === 'operation_clerk' || auth()->user()->privilege === 'investigation_clerk' || auth()->user()->privilege === 'operation_admin_chief' || auth()->user()->privilege === 'investigation_admin_chief') --}}
                <p class="">REPORTS</p>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $active == 'operation' ? 'active' : '' }}"
                        href="{{ route('operation.index') }}">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Operations</span>
                    </a>
                </li>
                {{-- @if (auth()->user()->privilege === 'investigation_clerk' || auth()->user()->privilege === 'investigation_admin_chief' || auth()->user()->privilege === 'configuration_chief') --}}
                <li class="sidebar-item">
                    <div class="accordion accordion-flush {{ $active == 'investigation' ? 'active' : '' }}"
                        href="{{ route('investigation.index') }}">
                        <div class="accordion-item p-0">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button sidebar-link {{ $active == 'investigation' || $active == 'minimal' || ($active == 'spot' || $active == 'progress') || $active == 'final' ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <span> <i class="ti ti-report"></i></span>
                                    <span class="hide-menu">Investigations</span>
                                </button>
                            </h2>
                            <div id="collapseOne"
                                class="accordion-collapse {{ $active == 'investigation' || $active == 'minimal' || ($active == 'spot' || $active == 'progress') || $active == 'final' ? '' : 'collapse' }}"
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
                                    Minimals
                                </a>
                                <a href="{{ route('investigation.spot.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'spot' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Spots
                                </a>
                                <a href="{{ route('investigation.progress.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'progress' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Progresses
                                </a>
                                <a href="{{ route('investigation.final.index') }}"
                                    class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'final' ? 'bg-primary text-light' : '' }}">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Finals
                                </a>


                                {{-- href="{{route('investigation.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'investigation' ? 'active' : ''}}" href="{{route(auth()->user()->type . '.dashboard')}}" --}}
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif
                @endif --}}


                <hr class="my-2">
                @if (auth()->user()->privilege === 'configuration_chief' || auth()->user()->privilege === 'chief')
                    <p class="">CONFIGURATIONS</p>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.occupancy.index') }}">
                            <span>
                                <i class="ti ti-building-community"></i>
                            </span>
                            <span class="hide-menu">Occupancies</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.barangay.index') }}">
                            <span>
                                <i class="ti ti-map-pin"></i>
                            </span>
                            <span class="hide-menu">Barangay</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.alarms.index') }}">
                            <span>
                                <i class="ti ti-bell-school"></i>
                            </span>
                            <span class="hide-menu">Alarms</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.trucks.index') }}">
                            <span>
                                <i class="ti ti-truck"></i>
                            </span>
                            <span class="hide-menu">Trucks</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.rank.index') }}">
                            <span>
                                <i class="ti ti-badge"></i>
                            </span>
                            <span class="hide-menu">Ranks</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.designation.index') }}">
                            <span>
                                <i class="ti ti-address-book"></i>
                            </span>
                            <span class="hide-menu">Designations</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.passcode.index') }}">
                            <span>
                                <i class="ti ti-address-book"></i>
                            </span>
                            <span class="hide-menu">Passcodes</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link {{ $active == 'personnel' ? 'bg-primary text-light' : '' }}"
                            href="{{ route('admin.personnel.index') }}">
                            <span> <i class="ti ti-users"></i></span>
                            <span class="hide-menu">Personnel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $active == 'personnel_search' ? 'bg-primary text-light' : '' }}"
                            href="{{ route('admin.personnel.search.index') }}">
                            <span> <i class="ti ti-users"></i></span>
                            <span class="hide-menu">Personnel Search</span>
                        </a>
                    </li> --}}
                @endif
                <hr class="my-2">

                @if (auth()->user()->privilege === 'operation_admin_chief' ||
                        auth()->user()->privilege === 'investigation_admin_chief' ||
                        auth()->user()->privilege === 'configuration_chief')
                    <p class="">ACTIVITIES</p>

                    <li class="sidebar-item">
                        <div class="accordion accordion-flush" id="logsAccordion">
                            <div class="accordion-item p-0">
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button sidebar-link {{ $active == 'viewOperationLogs' || $active == 'viewInvestigationLogs' || $active == 'configurationLog' ? '' : 'collapsed' }}"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogs"
                                        aria-expanded="{{ $active == 'viewOperationLogs' || $active == 'viewInvestigationLogs' || $active == 'configurationLog' ? 'true' : 'false' }}"
                                        aria-controls="collapseOne">
                                        <span> <i class="ti ti-file-description"></i></span>
                                        <span class="hide-menu">Logs</span>
                                    </button>
                                </h2>
                                <div id="collapseLogs"
                                    class="accordion-collapse {{ $active == 'viewOperationLogs' || $active == 'viewInvestigationLogs' || $active == 'configurationLog' ? '' : 'collapse' }}"
                                    data-bs-parent="#logsAccordion">

                                    @if (auth()->user()->privilege === 'operation_admin_chief')
                                        <a href="{{ route('admin.logs.operation.viewLogs') }}"
                                            class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'viewOperationLogs' ? 'bg-primary text-light' : '' }}">
                                            <span> <i class="ti ti-caret-right"></i></span>
                                            Operation
                                        </a>
                                    @endif

                                    @if (auth()->user()->privilege === 'investigation_admin_chief')
                                        <a href="{{ route('admin.logs.investigation.viewLogs') }}"
                                            class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'viewInvestigationLogs' ? 'bg-primary text-light' : '' }}">
                                            <span><i class="ti ti-caret-right"></i></span>
                                            Investigation
                                        </a>
                                    @endif

                                    @if (auth()->user()->privilege === 'configuration_chief')
                                        <a href="{{ route('admin.logs.configuration.viewLogs') }}"
                                            class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'configurationLog' ? 'bg-primary text-light' : '' }}">
                                            <span><i class="ti ti-caret-right"></i></span>
                                            Configurations
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                @if (auth()->user()->privilege === 'operation_admin_chief' || auth()->user()->privilege === 'investigation_admin_chief')
                    <li class="sidebar-item">
                        <div class="accordion accordion-flush" id="trashAccordion">
                            <div class="accordion-item p-0">
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button sidebar-link {{ $active == 'Investigation' || $active == 'Operation' ? '' : 'collapsed' }}"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTrash"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <span> <i class="ti ti-trash"></i></span>
                                        <span class="hide-menu">Trash</span>
                                    </button>
                                </h2>
                                <div id="collapseTrash"
                                    class="accordion-collapse {{ $active == 'Investigation' || $active == 'Operation' ? '' : 'collapse' }}"
                                    data-bs-parent="#trashAccordion">
                                    @if (auth()->user()->privilege === 'operation_admin_chief')
                                        <a href="{{ route('admin.trash.operation.index') }}"
                                            class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'Operation' ? 'bg-primary text-light' : '' }}">
                                            <span><i class="ti ti-caret-right"></i></span>
                                            Operation
                                        </a>
                                    @endif
                                    @if (auth()->user()->privilege === 'investigation_admin_chief')
                                        <a href="{{ route('admin.trash.investigation.index') }}"
                                            class="sidebar-link accordion-body ms-2 reports-collapse {{ $active == 'Investigation' ? 'bg-primary text-light' : '' }}">
                                            <span><i class="ti ti-caret-right"></i></span>
                                            Investigation
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                <hr class="my-2">
                @if (auth()->user()->privilege === 'configuration_chief')
                    <p class="">ACCOUNTS</p>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(auth()->user()->type . '.account.admin') }}">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Admin</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(auth()->user()->type . '.account.user') }}">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Users</span>
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

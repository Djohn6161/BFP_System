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
            <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
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
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link"  href="{{route('operation.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'operation' ? 'active' : ''}}">
                        <span>
                            <i class="ti ti-report"></i>
                        </span> 
                        <span class="hide-menu">Operation</span>
                    </a>
                    {{-- <div class="accordion accordion-flush" id="accordionExample">
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

                                
                            </div>
                        </div>
                    </div> --}}
                </li>
                <li class="sidebar-item">
                    <div class="accordion accordion-flush" href="{{route('investigation.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'investigation' ? 'active' : ''}}">
                        <div class="accordion-item p-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button sidebar-link" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span> <i class="ti ti-report"></i></span>
                                    <span class="hide-menu">Investigation</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                
                                <a href="{{route('investigation.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'investigation' ? 'active' : ''}}" > 
                                    All
                                </a>
                                <a href="{{route('investigation.minimal.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'minimal' ? 'active' : ''}}" href="{{route(auth()->user()->type . '.dashboard')}}"> 
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Minimal
                                </a>
                                <a href="#" class="sidebar-link accordion-body ms-2 reports-collapse">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Spot
                                </a>
                                <a href="#" class="sidebar-link accordion-body ms-2 reports-collapse">
                                    <span>
                                        <i class="ti ti-caret-right"></i>
                                    </span>
                                    Progress
                                </a>
                                <a href="#" class="sidebar-link accordion-body ms-2 reports-collapse">
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
                @if (auth()->user()->type === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route(auth()->user()->type . '.account')}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-circle"></i>
                            </span>
                            <span class="hide-menu">Accounts</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <div class="accordion accordion-flush" class="sidebar-link accordion-body ms-2 reports-collapse" id="personnelAccordion">
                            <div class="accordion-item p-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button sidebar-link" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePersonnel" aria-expanded="true" aria-controls="collapseOne">
                                        <span> <i class="ti ti-users"></i></span>
                                        <span class="hide-menu">Personnel</span>
                                    </button>
                                </h2>
                                <div id="collapsePersonnel" class="accordion-collapse collapse show"
                                    data-bs-parent="#personnelAccordion">
                                    
                                    <a href="{{route('personnel.index')}}" class="sidebar-link accordion-body ms-2 reports-collapse"> 
                                        Personnel Info
                                    </a>
                                    <a href="{{ route('admin.rank.index') }}" class="sidebar-link accordion-body ms-2 reports-collapse {{$active == 'rank' ? 'active' : ''}}"> 
                                        Ranks
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>    

                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Personnel</span>
                        </a>
                    </li> --}}

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
                                <i class="ti ti-trash"></i>
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

<!-- Header Start -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-success">
        <div class="navbar-nav">
            <div class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </div>
            <div class="navbar-nav flex-row ms-auto align-items-center justify-content-start">

                <div class="nav-item">
                    <div id="page-title" class="fw-bold fs-4"></div> <!-- Updated: Use CSS for styling -->
                </div>
            </div>
        </div>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            
            <div class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
               
                <div class="nav-item">
                    <div id="military-time" class="fw-bold fs-4"></div> 
                </div>
                <div class="nav-item">
                    <a id="" class="fw-bold fs-4 px-3 text-capitalize">Welcome, 
                        @if ($user->privilege == "All")
                            Super {{$user->name}}
                            @elseif($user->privilege == "OC")
                                Operator {{$user->name}}
                            @elseif($user->privilege == "IC")
                                Investigator {{$user->name}}
                            @elseif($user->privilege == "AC")
                                Admin {{$user->name}}
                        @endif    
                    </a> 
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover px-0" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img d="personnel-picture" src="/assets/images/personnel_images/{{$user->picture}}" alt="" width="40"
                            height="40" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body px-2">
                            <a href="{{ route('profile.myProfile') }}"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-5">My Profile</p> <!-- Updated: Use consistent font size -->
                            </a>
                            <a href="{{ route('profile.myPassword') }}"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-5">My Password</p> <!-- Updated: Use consistent font size -->
                            </a>
                            <button class="btn btn-outline-danger text-center w-100" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarItems = document.querySelectorAll(".sidebar-link");

        sidebarItems.forEach(function(item) {
            item.addEventListener("click", function(event) {
                // Get the text content of the clicked sidebar item
                const sidebarText = item.querySelector(".hide-menu").textContent;

                // Store the clicked sidebar item text in sessionStorage
                sessionStorage.setItem("clickedSidebarItem", sidebarText);
            });
        });

        // Function to update the time in military format
        function updateTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();
            const militaryTime =
                `${hours.toString().padStart(2, '0')}${minutes.toString().padStart(2, '0')}H:${seconds.toString().padStart(2, '0')}`;

            // Display the military time in a specified element
            document.getElementById("military-time").textContent = militaryTime;

            // Call updateTime function every second
            setTimeout(updateTime, 1000);
        }

        // Call updateTime function to initially display the time
        updateTime();

        // Check if there is a stored clicked sidebar item in sessionStorage and update the heading accordingly
        const storedSidebarItem = sessionStorage.getItem("clickedSidebarItem");
        if (storedSidebarItem) {
            document.getElementById("page-title").textContent = storedSidebarItem;
        }
    });
</script>

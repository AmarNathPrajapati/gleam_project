<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
    id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
            <img src="../images/logo.png" style="object-fit: cover; max-height: 40px;" alt="...">
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar-parent-child">
                        <!-- <img alt="Image Placeholder"
                                    src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                                    class="avatar avatar- rounded-circle"> -->
                        <span class="avatar-child avatar-badge bg-success"></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./dashboard.php">
                        <i class="bi bi-speedometer"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./universities.php">
                        <i class="bi bi-building"></i> Universities
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="./session_requests.php">
                        <i class="bi bi-person-plus"></i> Session Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./manage_agent.php">
                        <i class="bi bi-person"></i> Manage Agents
                    </a>
                </li> -->
                
                <li class="nav-item">
                    <a class="nav-link" href="./profile.php">
                        <i class="bi bi-person-square"></i> Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../backend/login_signup/logout.php">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">
                        <i class="bi bi-house"></i>Our Website
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Main Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo isset($title) && $title =='dashboard'?'active' : ''?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block"> 
            
            <!-- Nav Item - Sections -->
            <li class="nav-item <?php echo isset($title) && $title =='catagory'?'active' : ''?>">
                <a class="nav-link" href="catagory.php">
                <i class="fas fa-list"></i>
                    <span>Catagory</span></a>
            </li>
            <li class="nav-item <?php echo isset($title) && $title =='tag'?'active' : ''?>">
                <a class="nav-link" href="tag.php">
                <i class="fas fa-tags"></i>
                    <span>Tag</span></a>
            </li>
            <li class="nav-item <?php echo isset($title) && $title =='post'?'active' : ''?>">
                <a class="nav-link" href="post.php">
                    <i class="fas fa-newspaper"></i>
                    <span>Post</span></a>
            </li>
            <li class="nav-item <?php echo isset($title) && $title =='user'?'active' : ''?> ">
                <a class="nav-link" href="user_details.php">
                <i class="fas fa-users"></i>
                    <span>Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block"> 

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->
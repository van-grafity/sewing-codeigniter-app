<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= url_to('home') ?>" class="brand-link">
        <img src="<?= base_url('adminLTE'); ?>/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sewing App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="<?= url_to('home') ?>" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="ml-3 nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url_to('gls') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gls</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url_to('lines') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url_to('groups') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Groups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url_to('remarks') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Remarks</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= url_to('output-records') ?>" class="nav-link">
                        <i class="far fa-file-alt nav-icon"></i>
                        <p>Output Record</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url_to('slideshows') ?>" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>Slideshows Setting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url_to('dashboard-production') ?>" target="_blank" class="nav-link">
                        <i class="fas fa-tv nav-icon"></i>
                        <p>Dashboard Production</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url_to('dashboard_manager') ?>" target="_blank" class="nav-link">
                        <i class="fas fa-tv nav-icon"></i>
                        <p>Dashboard Manager</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= url_to('logout') ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
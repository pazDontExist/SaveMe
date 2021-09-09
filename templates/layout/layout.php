<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>SaveMe</title>

    <meta name="robots" content="noindex, nofollow">


    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="/assets/css/oneui.min.css">

    <?= $this->fetch('layout/css.php', ['assets' => $css ?? []]);?>

</head>
<body>
<!-- Page Container -->
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <!-- Side Overlay-->
    <aside id="side-overlay" class="fs-sm">
        <!-- Side Header -->
        <div class="content-header border-bottom">
            <!-- User Avatar -->
            <a class="img-link me-1" href="javascript:void(0)">
                <img class="img-avatar img-avatar32" src="/assets/media/avatars/avatar10.jpg" alt="">
            </a>
            <!-- END User Avatar -->
            <!-- END Close Side Overlay -->
        </div>
        <!-- END Side Header -->

        <!-- Side Content -->
        <!-- END Side Content -->
    </aside>
    <!-- END Side Overlay -->

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header">
            <!-- Logo -->
            <a class="fw-semibold text-dual" href="index.html">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
            </span>
                <span class="smini-hide fs-5 tracking-wider">
              Save<span class="fw-normal">Me</span>
            </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                    <i class="far fa-moon"></i>
                </button>
                <!-- END Dark Mode -->

                <!-- Options -->
                <div class="dropdown d-inline-block ms-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-circle"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                        <!-- Color Themes -->
                        <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="default" href="#">
                            <span>Default</span>
                            <i class="fa fa-circle text-default"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="/assets/css/themes/amethyst.min.css" href="#">
                            <span>Amethyst</span>
                            <i class="fa fa-circle text-amethyst"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="/assets/css/themes/city.min.css" href="#">
                            <span>City</span>
                            <i class="fa fa-circle text-city"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="/assets/css/themes/flat.min.css" href="#">
                            <span>Flat</span>
                            <i class="fa fa-circle text-flat"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="/assets/css/themes/modern.min.css" href="#">
                            <span>Modern</span>
                            <i class="fa fa-circle text-modern"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="/assets/css/themes/smooth.min.css" href="#">
                            <span>Smooth</span>
                            <i class="fa fa-circle text-smooth"></i>
                        </a>
                        <!-- END Color Themes -->

                        <div class="dropdown-divider"></div>

                        <!-- Sidebar Styles -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
                            <span>Sidebar Light</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
                            <span>Sidebar Dark</span>
                        </a>
                        <!-- END Sidebar Styles -->

                        <div class="dropdown-divider"></div>

                        <!-- Header Styles -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
                            <span>Header Light</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
                            <span>Header Dark</span>
                        </a>
                        <!-- END Header Styles -->
                    </div>
                </div>
                <!-- END Options -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-fw fa-times"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="/pages/home">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="/pages/reports">
                            <i class="nav-main-link-icon si si-list"></i>
                            <span class="nav-main-link-name"><?php echo __('Reports');?></span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="/pages/profile">
                            <i class="nav-main-link-icon si si-user"></i>
                            <span class="nav-main-link-name"><?php echo __('Profile');?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Toggle Mini Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                    <i class="fa fa-fw fa-ellipsis-v"></i>
                </button>
                <!-- END Toggle Mini Sidebar -->

                <!-- Open Search Section (visible on smaller screens) -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-sm-none" data-toggle="layout" data-action="header_search_on">
                    <i class="si si-magnifier"></i>
                </button>
                <!-- END Open Search Section -->

                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-sm-inline-block" method="POST">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                        <span class="input-group-text bg-body border-0">
                  <i class="si si-magnifier"></i>
                </span>
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="/assets/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ms-2"><?php echo $_SESSION['fname'];?></span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="/assets/media/avatars/avatar10.jpg" alt="">
                            <p class="mt-2 mb-0 fw-medium"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'];?></p>
                            <p class="mb-0 text-muted fs-sm fw-medium"><?php
                            if ($_SESSION['role'] == 1) {
                                echo __('REPORTER');
                            } elseif ($_SESSION['role'] == 2) {
                                echo __('DOGHOUSE');
                            } else {
                                echo __('LAW');
                            }
                            ?></p>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="/pages/profile">
                                <span class="fs-sm fw-medium">Profile</span>
                            </a>
                        </div>
                        <div role="separator" class="dropdown-divider m-0"></div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="/logout">
                                <span class="fs-sm fw-medium">Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <form class="w-100" method="POST">
                    <div class="input-group input-group-sm">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <?= $content ?>

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="#" target="_blank">Antonio D'Angelo</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    <a class="fw-semibold" href="#" target="_blank">SaveMe 1.0</a>  <span data-toggle="year-copy"></span> <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licenza Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>

<script src="/assets/js/lib/jquery.min.js"></script>
<script src="/assets/js/oneui.app.min.js"></script>

<?= $this->fetch('layout/js.php', ['assets' => $js ?? []]);?>
</body>
</html>

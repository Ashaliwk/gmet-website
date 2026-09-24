<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') | GMET Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/images/gmet-logo.png') }}">
    <link href="{{ url('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ url('backend/css/admin.min.css') }}" rel="stylesheet">
    <script src="{{ url('backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <link href="{{ url('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .sidebar-brand-icon img {
            max-height: 42px;
            border-radius: 6px;
        }

        .badge-status {
            font-size: 80%;
            padding: 4px 8px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center py-4 mt-2" href="{{ url('/admin') }}">
                <div class="sidebar-brand-icon">
                    <img
                        src="{{ asset('assets/images/gmet-logo.png') }}"
                        alt="GMET Logo"
                        style="
        width: 60px !important;
        height: 60px !important;
        max-width: none !important;
        max-height: none !important;
        object-fit: contain !important;
        border-radius: 20px;
    ">
                </div>

                <div class="sidebar-brand-text mx-2 font-weight-bold" style="letter-spacing: 0.5px;">
                    GMET
                    <span class="text-success font-weight-normal" style="font-size:11px; display:block;">
                        ADMIN
                    </span>
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::is('admin') ? 'active':''}}">
                <a class="nav-link" href="{{url('/admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                GMET Management
            </div>

            <!-- Services -->
            <li class="nav-item {{ Request::is('admin/services*', 'admin/service*') ? 'active':''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices"
                    aria-expanded="true" aria-controls="collapseServices">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Services</span>
                </a>
                <div id="collapseServices" class="collapse {{ Request::is('admin/services*', 'admin/service*') ? 'show':''}}" aria-labelledby="headingServices" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/services') ? 'active':''}}" href="{{url('/admin/services')}}">All Services</a>
                        <a class="collapse-item {{ Request::is('admin/service-add') ? 'active':''}}" href="{{url('/admin/service-add')}}">Add New Service</a>
                    </div>
                </div>
            </li>

            <!-- Team -->
            <li class="nav-item {{ Request::is('admin/team*') ? 'active':''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeam"
                    aria-expanded="true" aria-controls="collapseTeam">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Team Management</span>
                </a>
                <div id="collapseTeam" class="collapse {{ Request::is('admin/team*') ? 'show':''}}" aria-labelledby="team" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/team') ? 'active':''}}" href="{{url('/admin/team')}}">All Team Members</a>
                        <a class="collapse-item {{ Request::is('admin/team-add') ? 'active':''}}" href="{{url('/admin/team-add')}}">Add Team Member</a>
                    </div>
                </div>
            </li>

            <!-- Projects -->
            <li class="nav-item {{ Request::is('admin/project*') ? 'active':''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProjects"
                    aria-expanded="true" aria-controls="collapseProjects">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Projects</span>
                </a>
                <div id="collapseProjects" class="collapse {{ Request::is('admin/project*') ? 'show':''}}" aria-labelledby="headingProjects" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/projects') ? 'active':''}}" href="{{url('/admin/projects')}}">All Projects</a>
                        <a class="collapse-item {{ Request::is('admin/project-add') ? 'active':''}}" href="{{url('/admin/project-add')}}">Add Project</a>
                    </div>
                </div>
            </li>

            <!-- Partners -->
            <li class="nav-item {{ Request::is('admin/partner*') ? 'active':''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartners"
                    aria-expanded="true" aria-controls="collapsePartners">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Partners & Clients</span>
                </a>
                <div id="collapsePartners" class="collapse {{ Request::is('admin/partner*') ? 'show':''}}" aria-labelledby="headingPartners" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/partners') ? 'active':''}}" href="{{url('/admin/partners')}}">All Partners</a>
                        <a class="collapse-item {{ Request::is('admin/partner-add') ? 'active':''}}" href="{{url('/admin/partner-add')}}">Add Partner</a>
                    </div>
                </div>
            </li>

            <!-- Inquiries / Contact -->
            <li class="nav-item {{ Request::is('admin/contacts*') ? 'active':''}}">
                <a class="nav-link" href="{{url('/admin/contacts')}}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Contact Inquiries</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Administration
            </div>

            <!-- Authentication / Admins -->
            <li class="nav-item {{ Request::is('admin/register', 'admin/admins-list', 'admin/password-reset') ? 'active':''}}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthentication"
                    aria-expanded="true" aria-controls="collapseAuthentication">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>Admin Accounts</span>
                </a>
                <div id="collapseAuthentication" class="collapse {{ Request::is('admin/register', 'admin/admins-list') ? 'show':''}}" aria-labelledby="headingAuthentication"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/admins-list') ? 'active':''}}" href="{{url('/admin/admins-list')}}">Admin List</a>
                        <a class="collapse-item {{ Request::is('admin/register') ? 'active':''}}" href="{{url('/admin/register')}}">Add an Admin</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-info" href="{{url('/')}}" target="_blank">
                    <i class="fas fa-fw fa-external-link-alt text-info"></i>
                    <span>View GMET Website</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="{{url('/admin/logout')}}">
                    <i class="fas fa-fw fa-power-off text-danger"></i>
                    <span>Logout</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <span class="text-dark font-weight-bold" style="font-size: 15px;">
                            Geo Mapping Engineering & Technologies — Management Console
                        </span>
                    </div>

                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item mr-3">
                            <a class="btn btn-sm btn-outline-success font-weight-bold" href="{{ url('/') }}" target="_blank">
                                <i class="fas fa-globe mr-1"></i> Live Website
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">
                                    {{ session('first_name') ? session('first_name').' '.session('last_name') : 'Administrator' }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ url('backend/images/profile.svg')}}" alt="Admin">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/admin/admins-list') }}">
                                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin Users
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{url('/admin/logout')}}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
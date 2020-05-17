<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                @if(auth('admin')->check())
                <li class="app-sidebar__heading">Statistics</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                @endif
                <li class="app-sidebar__heading">School Material</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Subjects
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            @if(auth('admin')->check())
                            <a href="{{ route('admin.standard.index') }}">
                                <i class="metismenu-icon"></i>
                                Class Wise
                            </a>
                            @elseif(auth('school')->check())
                            <a href="{{ route('school.subjects') }}">
                                <i class="metismenu-icon"></i>
                                Class Wise
                            </a>
                            @else
                            <a href="{{ route('subjects') }}">
                                <i class="metismenu-icon"></i>
                                Class Wise
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>

                @if(auth('admin')->check())
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Students
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.student.index') }}">
                                <i class="metismenu-icon"></i>
                                Listing
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Class
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.school.index') }}">
                                <i class="metismenu-icon"></i>
                                Logins
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
            </ul>
        </div>
    </div>
</div>
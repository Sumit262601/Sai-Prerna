<div class="header">
    <div class="pull-left">
        <div class="logo"><a href="<?= site_url(); ?>"><span>SAI-PRERNA</span></a></div>
        <div class="hamburger sidebar-toggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="pull-right p-r-15">
        <ul>
            <li class="header-icon dib">
                <img class="avatar-img" src="<?= base_url("assets/images/avatar/1.jpg"); ?>" alt="" /> 
                <span class="user-avatar">
                    <i class="ti-angle-down f-s-10"></i>
                </span>
                <div class="drop-down dropdown-profile">
                    <div class="dropdown-content-body">
                        <ul>
							<li><a href="<?= site_url('lms/changepassword'); ?>"><i class="ti-key"></i> <span>Change password</span></a></li>
                            <li><a href="<?= site_url('web-admin'); ?>"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="preloader"></div>
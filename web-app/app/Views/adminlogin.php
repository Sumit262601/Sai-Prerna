<!DOCTYPE html>
<html lang="en">
<head>
<?php include('admin/common/header_script.php'); ?>
    <style>
        #forhetPass{
            display: none;
        }
    </style>
</head>

<body class="bg-primary" style="background-image: url(assets/images/scrollable/view1.jpg); background-position: center; background-size: cover;">
    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
					<?php if($allow){ ?>
                        <div class="login-form" id="loginghg">
                            <h4>WTV Admin Login</h4>
                            <form class="form-submit" action="<?= site_url('admin-login'); ?>">
                                <div class="form-group">
                                    <label>Admin Login</label>
                                    <input type="text" class="form-control" placeholder="Email" name="user_email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="user_pass">
                                </div>
                                <div class="form-group">
                                    <input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30">Sign in</button>
                                </div>
                                <div class="register-link text-center">
                                    <p>
										<a href="#" id="forgouij">Forgotten Password?</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="login-form" id="forhetPass">
                            <h4>Reset Password</h4>
                            <form class="form-submit" action="<?= site_url('admin-forgot'); ?>">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" name="forget_email">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>
                                <div class="register-link text-center">
                                    <p>Back to <a href="#" id="backtolog"> Login</a></p>
                                </div>
                            </form>
                        </div>
					<?php }else{ ?>
						<div class="login-form">
                            <h4>Your IP Address has not allowed to access: <?=$ip;?> </h4>
                        </div>
					<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="preloader"></div>
</body>
    <script src="<?= base_url('assets/js/lib/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/lib/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/mynew.js'); ?>"></script>
</html>
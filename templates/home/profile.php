<main id="main-container">

    <!-- Hero -->
    <div class="bg-image" style="background-image: url('/assets/media/photos/photo10@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="/assets/media/avatars/avatar13.jpg" alt="">
                </div>
                <h1 class="h2 text-white mb-0"><?php echo __('Edit Account');?></h1>
                <h2 class="h4 fw-normal text-white-75">
                    <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'];?>
                </h2>
                <a class="btn btn-alt-secondary" href="/pages/home">
                    <i class="fa fa-fw fa-arrow-left text-danger"></i> <?php echo __('Back');?>
                </a>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"><?php echo __('User Profile');?></h3>
            </div>
            <div class="block-content">
                <form action="be_pages_projects_edit.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                <?php echo __('Here you can manage the basic information of your account');?>
                            </p>
                            <div id="basic_info_result"></div>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-surname">Surname</label>
                                <input type="text" class="form-control" id="one-profile-edit-surname" name="one-profile-edit-username" placeholder="Enter your username.." value="<?php echo $_SESSION['lname']?>">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-name">Name</label>
                                <input type="text" class="form-control" id="one-profile-edit-name" name="one-profile-edit-name" placeholder="Enter your name.." value="<?php echo $_SESSION['fname']?>">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-email">Email Address</label>
                                <input type="email" class="form-control" id="one-profile-edit-email" name="one-profile-edit-email" placeholder="Enter your email.." value="<?php echo $_SESSION['email']?>">
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary" onclick="update_basic_info();">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"><?php echo __('Change Password');?></h3>
            </div>
            <div class="block-content">
                <form id="frm_change_passwd" method="POST" onsubmit="return false;">
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                <?php echo __('Changing your sign in password is an easy way to keep your account secure.');?>
                            </p>
                            <div id="change_password_result"></div>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="one-profile-edit-password-new"><?php echo __('New Password');?></label>
                                    <input type="password" class="form-control" id="one-profile-edit-password-new" name="one-profile-edit-password-new">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="one-profile-edit-password-new-confirm"><?php echo __('Confirm Password');?></label>
                                    <input type="password" class="form-control" id="one-profile-edit-password-new-confirm" name="one-profile-edit-password-new-confirm">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary" onclick="update_password();">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->
    </div>
    <!-- END Page Content -->
</main>
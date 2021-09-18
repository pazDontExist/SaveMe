<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        <?php echo __('New Report');?>
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        <?php echo __('Welcome') . " " . $_SESSION['fname']; ?>
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="/pages/home"><?php echo __('Dashboard');?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)"><?php echo __('New Report');?></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"><?php echo __('New Report');?></h3>
            </div>
            <div class="block-content block-content-full">
                <form action="/api/reports/new" method="POST" enctype="multipart/form-data" id="frm_new_report">
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="full_addr"><?php echo __('Address');?></label>
                                <input type="text" class="form-control form-check-inline" id="full_addr" name="full_addr" placeholder="<?php echo __('Address');?>">
                                <hr><a onclick="address_to_coord()" class="btn btn-success">Get Lat-Lon From Address</a>&nbsp;
                                <a onclick="set_position()" class="btn btn-success">Get Lat-Lon from Position</a>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="lat"><?php echo __('Latitude');?></label>
                                <input type="text" class="form-control" id="lat" name="lat" placeholder="<?php echo __('45.123456');?>">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="lon"><?php echo __('Longitude');?></label>
                                <input type="text" class="form-control" id="lon" name="lon" placeholder="<?php echo __('12.987654');?>">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="notes"><?php echo __('Note');?></label>
                                <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="photo" class="form-label"><?php echo __('Photo');?></label>
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                            <div class="mb-4">
                                <label for="report_type" class="form-label"><?php echo __('Report Type');?></label>
                                <select name="report_type" id="report_type" class="form-control">
                                    <option value="1"> Bad Condition</option>
                                    <option value="2"> Abandoned</option>
                                    <option value="3"> Stray</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <input class="form-control btn btn-success" type="submit" value="<?php echo __('Send');?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
</main>
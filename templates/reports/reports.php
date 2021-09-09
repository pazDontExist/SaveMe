<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        <?php echo __('Reports');?>
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        <?php echo __('Welcome') . " " . $_SESSION['fname']; ?>
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)"><?php echo __('Reports');?></a>
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
                <h3 class="block-title">
                    <?php echo __('All Reports');?>
                </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </div>
            </div>
            <div class="block-content fs-sm">
                <table class="table table-hover table-vcenter table-responsive" style="width: 100%" id="tbl_all_reports">
                    <thead>
                    <th>#</th>
                    <th><?php echo __('Reporter');?></th>
                    <th><?php echo __('Type');?></th>
                    <th><?php echo __('Location');?></th>
                    <th><?php echo __('Created At');?></th>
                    <th><?php echo __('Status');?></th>
                    <th><?php echo __('Actions');?></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
</main>

<!-- Large Block Modal -->
<div class="modal" id="modal-report-detail" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title"><?php echo __('Report Detail');?></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <i class="fa fa-4x fa-cog fa-spin text-warning" id="loader"></i>
                    <div class="row">

                        <div class="col-6">
                            <span class="text text-black-50"><?php echo __('Report Type');?></span>
                            <span id="report_type"></span><br><br>

                            <span class="text text-black-50"><?php echo __('Photo');?></span><br>
                            <img id="photo" width="100%" height="auto"/><br><br>

                            <span class="text text-black-50"><?php echo __('Notes');?></span><br>
                            <textarea class="form-control" id="notes"></textarea><br>
                        </div>

                        <div class="col-6">
                            <div id="map"></div>
                            <span class="text text-black-50"><?php echo __('Coordinates');?></span>
                            <span id="coordinates"></span><br><br>
                            <span class="text text-black-50"><?php echo __('Full Address');?></span>
                            <span id="full_addr"></span><br><br>
                            <span class="text text-black-50"><?php echo __('Created at');?></span>
                            <span id="created_at"></span><br><br>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Perfect</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->
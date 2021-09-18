<?php

use App\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    });

    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');

    // Swagger API documentation
    $app->get('/docs/v1', \App\Action\OpenApi\Version1DocAction::class)->setName('docs');

    $app->post('/login', \App\Action\Auth\LoginSubmitAction::class)->setName('login');
    $app->post('/register', \App\Action\Users\UserCreateAction::class);

    $app->get('/logout', \App\Action\Auth\LogoutAction::class);


    $app->group('/public', function (RouteCollectorProxy $group) {
        $group->get("/login", \App\Action\Pages\LoginPageAction::class)->setName('public_login');
        $group->get("/register", \App\Action\Pages\RegisterPageAction::class)->setName('public_login');
    });

    $app->group('/pages', function (RouteCollectorProxy $group) {
        $group->get("/home", \App\Action\Pages\HomePageAction::class)->setName('pages-home');
        $group->get("/profile", \App\Action\Pages\ProfilePageAction::class)->setName('profile-home');
        $group->get("/reports", \App\Action\Pages\ReportsPageAction::class)->setName('reports');
        $group->get("/new_report", \App\Action\Pages\NewReportPageAction::class)->setName('new-reports');
    })->add(UserAuthMiddleware::class);

    // API endpoints. This group is protected with JWT.
    $app->group('/api', function (RouteCollectorProxy $group) {
        /**
         * Retrieve User information
         */
        $group->get('/user/detail/{id}', \App\Action\Users\UserReadAction::class);

        /**
         * Delete user
         */
        $group->get('/user/delete/{id}', \App\Action\Users\UserDeleteAction::class);

        /**
         * List all users
         */
        $group->get('/user/list', \App\Action\Users\UserFindAction::class);

        /**
         * Add User
         */
        $group->post('/user/add', \App\Action\Users\UserCreateAction::class);

        /**
         * Update User
         */
        $group->post('/user/update', \App\Action\Users\UserUpdateAction::class);

        $group->post('/user/password/update', \App\Action\Users\UserPasswordChange::class);

        /********* END USER SECTION ************/

        /********* REPORT SECTION ************/
        /**
         * Retrieve Report information
         */
        $group->get('/reports/detail/{id}', \App\Action\Reports\ReportDetailAction::class);

        /**
         * List Reports for datatable
         */
        $group->get('/reports/list/[{status}]', \App\Action\Reports\ReportListAction::class);

        /**
         * Add new report
         */
        $group->post('/reports/new', \App\Action\Reports\ReportNewAction::class);

        $group->get('/reports/takecharge/{report_id}', \App\Action\Reports\ReportTakeChargeAction::class);

        $group->get('/reports/delete/{id}', \App\Action\Reports\ReportDeleteAction::class);
        /********* END REPORT SECTION ************/

        /**
         * Image renderer
         */
        $group->get('/img/{photo}/{extension}', \App\Action\Reports\ReportImageRender::class);
    })->add(UserAuthMiddleware::class);

    $app->group('/statistics', function (RouteCollectorProxy $group) {

        $group->get('/reports/total', \App\Action\Statistics\StatisticsTotalReport::class);
        $group->get('/user/total', \App\Action\Statistics\StatisticsTotalUsers::class);
    });

    /*
    $app->group('/mobile', function (RouteCollectorProxy $group) {
        $group->post('/reports/new', \App\Action\Reports\ReportNewAction::class);
    });*/
};

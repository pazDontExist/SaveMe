<?php

namespace App\Action\Statistics;

use App\Domain\Statistics\Repository\StatisticsRespository;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class StatisticsTotalReport
{

    private StatisticsRespository $statisticsRespository;
    private Responder $responder;

    /**
     * The constructor.
     *
     * @param ReportReader $reportReader The service
     * @param Responder $responder The responder
     */
    public function __construct(StatisticsRespository $statisticsRespository, Responder $responder)
    {
        $this->statisticsRespository = $statisticsRespository;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<mixed> $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {


        return $this->responder->withJson($response, $this->statisticsRespository->countAllReports());
    }
}

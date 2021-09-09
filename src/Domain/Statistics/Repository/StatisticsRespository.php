<?php

namespace App\Domain\Statistics\Repository;

use App\Domain\Reports\Data\ReportData;
use App\Factory\QueryFactory;
use App\LugCE\Definition;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository.
 */
final class StatisticsRespository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function countAllReports(): array
    {
        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'COUNT(*) AS total_pending',
            ]
        );

        $query->andWhere("status = 1");
        $pending = $query->execute()->fetch('assoc');

        if (empty($pending)) {
            $pending = 0;
        }

        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'COUNT(*) AS total_working',
            ]
        );

        $query->andWhere("status = 2");
        $working = $query->execute()->fetch('assoc');

        if (empty($working)) {
            $working = 0;
        }
        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'COUNT(*) AS total_closed',
            ]
        );

        $query->andWhere("status = 3");
        $closed = $query->execute()->fetch('assoc');

        if (empty($closed)) {
            $closed = 0;
        }

        return ['total_pending' => $pending['total_pending'], 'total_working' => $working['total_working'], 'total_closed' => $closed['total_closed']];
    }

    function countAllUsers(){
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'COUNT(*) AS total_user',
            ]
        );

        $query->andWhere('user_type = 1');

        $total_user = $query->execute()->fetch('assoc');

        if (empty($total_user)) {
            $total_user = 0;
        }

        return ['total_user' => $total_user['total_user']];
    }
}

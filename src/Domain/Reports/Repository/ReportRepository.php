<?php

namespace App\Domain\Reports\Repository;

use App\Domain\Reports\Data\ReportData;
use App\Factory\QueryFactory;
use App\LugCE\Definition;
use Cake\Chronos\Chronos;
use DomainException;
use PHPUnit\Exception;

/**
 * Repository.
 */
final class ReportRepository
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

    /**
     * Insert report row.
     *
     * @param ReportData $report The report data
     *
     * @return int The new ID
     */
    public function insertReport(ReportData $report): int
    {
        $row = $this->toRow($report);
        $row['created_at'] = Chronos::now()->toDateTimeString();
        $row['updated_at'] = Chronos::now()->toDateTimeString();
        $row['status'] = Definition::PENDING;

        return (int)$this->queryFactory->newInsert('reports', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * List Report for Datatable
     * @return array
     */
    public function listReports($status): array
    {
        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'reports.id',
                'reports.photo',
                'reports.user_id',
                'reports.lon',
                'reports.lat',
                'reports.status',
                'reports.notes',
                'reports.report_type',
                'reports.created_at',
                'reports.updated_at',
                'reports.full_addr',
                'reports.city',
                'reports.county',
                'users.first_name',
                'users.last_name',
                'users.id AS user_id',
            ]
        );

        $query->innerJoin('users', "reports.user_id = users.id");

        if ($status !== null) {
            $status = filter_var($status, FILTER_SANITIZE_NUMBER_INT);
            $query->andWhere("reports.status = $status");
        }

        $row = $query->execute()->fetchAll('assoc');

        if (empty($row)) {
            $row = [];
        }

        return ['data' => $row];
    }

    /**
     * @param $status
     * @return array
     */
    public function listReportsUser($status): array
    {
        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'reports.id',
                'reports.photo',
                'reports.user_id',
                'reports.lon',
                'reports.lat',
                'reports.status',
                'reports.notes',
                'reports.report_type',
                'reports.created_at',
                'reports.updated_at',
                'reports.full_addr',
                'reports.city',
                'reports.county',
                'users.first_name',
                'users.last_name',
                'users.id AS user_id',
            ]
        );

        $query->innerJoin('users', "reports.user_id = users.id");

        if ($status !== null) {
            $status = filter_var($status, FILTER_SANITIZE_NUMBER_INT);
            $query->andWhere("reports.status = $status AND reports.user_id = " . $_SESSION['user']);
        }

        $row = $query->execute()->fetchAll('assoc');

        if (empty($row)) {
            $row = [];
        }

        return ['data' => $row];
    }


    /**
     * Get report by id.
     *
     * @param int $reportID The vlt id
     *
     * @throws DomainException
     *
     * @return ReportData The report
     */
    public function getReportByID(int $reportID): ReportData
    {
        $query = $this->queryFactory->newSelect('reports');
        $query->select(
            [
                'reports.id',
                'reports.photo',
                'reports.lon',
                'reports.lat',
                'reports.status',
                'reports.notes',
                'reports.report_type',
                'reports.created_at',
                'reports.updated_at',
                'reports.full_addr',
                'reports.city',
                'reports.county',
                'users.first_name',
                'users.last_name',
                'users.id AS user_id',
            ]
        );

        $query->innerJoin('users', "reports.user_id = users.id");

        $query->andWhere(['reports.id' => $reportID]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('VLT not found: %s', $reportID));
            //$row = [];
        }

        return new ReportData($row);
    }

    /**
     * Update report row.
     *
     * @param ReportData $vlt The vlt
     *
     * @return void
     */
    public function updateReport(ReportData $report): void
    {
        $row = $this->toRow($report);

        $row['updated_at'] = Chronos::now()->toDateTimeString();

        $this->queryFactory->newUpdate('reports', $row)
            ->andWhere(['id' => $report->id])
            ->execute();
    }

    /**
     * Check report id.
     *
     * @param int $reportId The vlt id
     *
     * @return bool True if exists
     */
    public function existsReportId(int $reportId): bool
    {
        $query = $this->queryFactory->newSelect('report');
        $query->select('id')->andWhere(['id' => $reportId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete report row.
     *
     * @param int $reportID The vlt id
     *
     * @return void
     */
    public function deleteReportById(int $reportID): void
    {
        $this->queryFactory->newDelete('reports')
            ->andWhere(['id' => $reportID])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param ReportData $report The vlt data
     *
     * @return array The array
     */
    private function toRow(ReportData $report): array
    {
        return [
            'id'            => $report->id,
            'photo'         => $report->photo,
            'user_id'       => $report->user_id,
            'lon'           => $report->lon,
            'lat'           => $report->lat,
            'status'        => $report->status,
            'notes'         => $report->notes,
            'report_type'   => $report->report_type,
            'created_at'    => $report->created_at,
            'updated_at'    => $report->updated_at,
            'full_addr'     => $report->full_addr,
            'city'          => $report->city,
            'county'        => $report->county,
        ];
    }


    /**
     * @param array $row
     * @return array
     */
    public function takeCharge(array $row): array
    {
        $row['created_at'] = Chronos::now()->toDateTimeString();
        try {
            $tk_id = (int)$this->queryFactory->newInsert('taken_charge', $row)
                ->execute()
                ->lastInsertId();

            $upd = ['status' => Definition::WORKING];
            $rep = $this->queryFactory->newUpdate("reports", $upd)
                ->andWhere(['id'=>$row['report_id']])
                ->execute();

        } catch (\Exception $e) {
            return ['status'=>'error', 'message' => $e->getCode()] ;
        }

        return ['status'=>'success','charge_id' => $tk_id, 'message' => __('Report Assigned')] ;
    }
}

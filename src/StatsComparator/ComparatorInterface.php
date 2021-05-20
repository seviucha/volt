<?php


namespace App\StatsComparator;


use App\StatsFetcher\StatValues;

interface ComparatorInterface
{
    /**
     * Compares two StatValues objects.
     * It should return 1 when first value is greater then second, -1 if less and 0 when equal.
     *
     * @param StatValues $stats1
     * @param StatValues $stats2
     *
     * @return array
     */
    public function compare(StatValues $stats1, StatValues $stats2): array;
}

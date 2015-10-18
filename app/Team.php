<?php

namespace CMV;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

use Laravel\Spark\Teams\Team as SparkTeam;

class Team extends SparkTeam implements BillableContract
{
    use Billable;
}

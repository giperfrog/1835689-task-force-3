<?php

require_once('classes/StatusTask.php');

$statusTask = new StatusTask(1, 2, 'new');

assert($statusTask->getNextStatus(self::$customerId, self::ACTION_CANCEL) === self::$statusName[self::STATUS_CANCEL]);
assert($statusTask->getNextStatus(self::$customerId, self::ACTION_ACCEPT) === self::$statusName[self::STATUS_IN_WORK]);
assert($statusTask->getNextStatus(self::$customerId, self::ACTION_DONE) === self::$statusName[self::STATUS_DONE]);
assert($statusTask->getNextStatus(self::$contractorId, self::ACTION_FAIL) === self::$statusName[self::STATUS_FAIL]);

echo 'Completed';

<?php

require_once('classes/StatusTask.php');

$statusTask = new StatusTask(1, 2, 'new');

assert($statusTask->getNextStatus(self::$statusName['STATUS_NEW'], self::$customerId, self::ACTION_CANCEL) === self::$statusName['STATUS_CANCEL']);
assert($statusTask->getNextStatus(self::$statusName['STATUS_NEW'], self::$customerId, self::ACTION_ACCEPT) === self::$statusName['STATUS_IN_WORK']);
assert($statusTask->getNextStatus(self::$statusName['STATUS_IN_WORK'], self::$customerId, self::ACTION_DONE) === self::$statusName['STATUS_DONE']);
assert($statusTask->getNextStatus(self::$statusName['STATUS_IN_WORK'], self::$contractorId, self::ACTION_FAIL) === self::$statusName['STATUS_FAIL']);

echo 'Completed';

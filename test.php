<?php

require_once('classes/StatusTask.php');

$statusTask = new StatusTask(1, 2);

assert($statusTask->getNextStatus(self::ACTION_CANCEL, 'Новое') === self::$statusName['STATUS_CANCEL']);
assert($statusTask->getNextStatus(self::ACTION_RESPOND, 'Новое') === self::$statusName['STATUS_IN_WORK']);
assert($statusTask->getNextStatus(self::ACTION_DONE, 'В работе') === self::$statusName['STATUS_DONE']);
assert($statusTask->getNextStatus(self::ACTION_FAIL, 'В работе') === self::$statusName['STATUS_FAIL']);

echo 'Completed';

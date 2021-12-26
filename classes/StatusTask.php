<?php

class StatusTask
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancelled';
    const STATUS_IN_WORK = 'in work';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'failed';
    const ACTION_CANCEL = 'action cancel';
    const ACTION_RESPOND = 'action respond';
    const ACTION_ACCEPT = 'action accept';
    const ACTION_DONE = 'action done';
    const ACTION_FAIL = 'action fail';

    private $customerId;
    private $contractorId;
    public $current_state;

    private static $statusName =
    [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено'
    ];

    private static $actionName =
    [
        self::ACTION_CANCEL => 'Отменить задание',
        self::ACTION_RESPOND => 'Откликнуться на задание',
        self::ACTION_ACCEPT => 'Принять',
        self::ACTION_DONE => 'Выполнить задание',
        self::ACTION_FAIL => 'Отказаться от задания'
    ];

    public function __construct(int $customerId, int $contractorId, $current_state)
    {
        $this->customerId = $customerId;
        $this->contractorId = $contractorId;
        $this->current_state = $current_state;
    }

    public static function getNextStatus($current_state, $user_id, $action)
    {
        if ($current_state === self::$statusName['STATUS_NEW'] && $user_id === self::$customerId && $action === self::ACTION_CANCEL) {
            return self::$statusName['STATUS_CANCEL'];
        }
        if ($current_state === self::$statusName['STATUS_NEW'] && $user_id === self::$customerId && $action === self::ACTION_ACCEPT) {
            return self::$statusName['STATUS_IN_WORK'];
        }
        if ($current_state = self::$statusName['STATUS_IN_WORK'] && $user_id === self::$customerId && $action === self::ACTION_DONE) {
            return self::$statusName['STATUS_DONE'];
        }
        if ($current_state = self::$statusName['STATUS_IN_WORK'] && $user_id === self::$contractorId && $action === self::ACTION_FAIL) {
            return self::$statusName['STATUS_FAIL'];
        }
    }

    public static function getAction($current_state, $user_id)
    {
        if ($current_state === self::$statusName['STATUS_NEW'] && $user_id === self::$customerId) {
            return self::$actionName['ACTION_CANCEL'] && self::$actionName['ACTION_ACCEPT'];
        }
        if ($current_state === self::$statusName['STATUS_NEW'] && $user_id === self::$contractorId) {
            return  self::$actionName['ACTION_RESPOND'];
        }
        if ($current_state = self::$statusName['STATUS_IN_WORK'] && $user_id === self::$customerId) {
            return self::$actionName['ACTION_DONE'];
        }
        if ($current_state = self::$statusName['STATUS_IN_WORK'] && $user_id === self::$contractorId) {
            return self::$actionName['ACTION_FAIL'];
        }
    }
}

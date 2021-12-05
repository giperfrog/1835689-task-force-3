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
    const ACTION_DONE = 'action done';
    const ACTION_FAIL = 'action fail';

    private $customerId;
    private $contractorId;

    private static $statusName = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено'
    ];

    private static $actionName = [
        self::ACTION_CANCEL => 'Отменить задание',
        self::ACTION_RESPOND =>'Откликнуться на задание',
        self::ACTION_DONE => 'Выполнить задание',
        self::ACTION_FAIL => 'Отказаться от задания'
    ];

    public function __construct(int $customerId, int $contractorId)
    {
        $this->customerId = $customerId;
        $this->contractorId = $contractorId;
    }

    public static function getNextStatus($action)
    {
        if ($action === self::ACTION_CANCEL) {
            return self::$statusName['STATUS_CANCEL'];
        }
        if ($action === self::ACTION_RESPOND) {
            return self::$statusName['STATUS_IN_WORK'];
        }
        if ($action === self::ACTION_DONE) {
            return self::$statusName['STATUS_DONE'];
        }
        if ($action === self::ACTION_FAIL) {
            return self::$statusName['STATUS_FAIL'];
        }
        else
        {
            return self::$statusName['STATUS_NEW'];
        }
    }

    public static function getAction($current_state)
    {
        $current_state = self::getNextStatus(self::$statusName[]);
            switch ($current_state) {
                case 'Новое':
                    if (self::$customerId) {
                        return self::$actionName['ACTION_CANCEL'];
                    }
                    if (self::$contractorId) {
                        return  self::$actionName['ACTION_RESPOND'];
                    }
                case 'В работе':
                    if (self::$customerId) {
                        return self::$actionName['ACTION_DONE'];
                    }
                    if (self::$contractorId) {
                        return self::$actionName['ACTION_FAIL'];
                    }
            }
    }
}

<?php

namespace Dns1835689TaskForce3\service;

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
    private $current_state;

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

    public function getNextStatus($user_id, $action)
    {
        if ($this->current_state === self::$statusName[self::STATUS_NEW] && $user_id === $this->customerId && $action === self::ACTION_CANCEL) {
            return self::$statusName[self::STATUS_CANCEL];
        }
        if ($this->current_state === self::$statusName[self::STATUS_NEW] && $user_id === $this->customerId && $action === self::ACTION_ACCEPT) {
            return self::$statusName[self::STATUS_IN_WORK];
        }
        if ($this->current_state = self::$statusName[self::STATUS_IN_WORK] && $user_id === $this->customerId && $action === self::ACTION_DONE) {
            return self::$statusName[self::STATUS_DONE];
        }
        if ($this->current_state = self::$statusName[self::STATUS_IN_WORK] && $user_id === $this->contractorId && $action === self::ACTION_FAIL) {
            return self::$statusName[self::STATUS_FAIL];
        }
    }

    public function getAction($user_id)
    {
        if ($this->current_state === self::$statusName[self::STATUS_NEW] && $user_id === $this->customerId) {
            return self::$actionName[self::ACTION_CANCEL] && self::$actionName[self::ACTION_ACCEPT];
        }
        if ($this->current_state === self::$statusName[self::STATUS_NEW] && $user_id === $this->contractorId) {
            return  self::$actionName[self::ACTION_RESPOND];
        }
        if ($this->current_state = self::$statusName[self::STATUS_IN_WORK] && $user_id === $this->customerId) {
            return self::$actionName[self::ACTION_DONE];
        }
        if ($this->current_state = self::$statusName[self::STATUS_IN_WORK] && $user_id === $this->contractorId) {
            return self::$actionName[self::ACTION_FAIL];
        }
    }
}

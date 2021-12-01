<php?
class StatusTask
{
    const STATUS_NEW='new';
    const STATUS_CANCEL='cancel';
    const STATUS_IN_WORK='in_work';
    const STATUS_DONE='done';
    const STATUS_FAIL='fail';
    const ACTION_CANCEL='action_cancel';
    const ACTION_RESPOND='action_respond';
    const ACTION_DONE='action_done';
    const ACTION_FAIL='action_fail';

    public $customerId = [];
    public $userId = [];

    public $map = [
        'STATUS_NEW' => 'Новое',
        'STATUS_CANCEL' => 'Отменено',
        'STATUS_IN_WORK' => 'В работе',
        'STATUS_DONE' => 'Выполнено',
        'STATUS_FAIL' => 'Провалено',
        'ACTION_CANCEL' => 'Отменить',
        'ACTION_RESPOND' => 'Откликнуться',
        'ACTION_DONE' => 'Выполнить',
        'ACTION_FAIL' => 'Отказаться'
        ];

    public function __construct($customerId, $userId) {
        $this->customerId = $customerId;
        $this->userId = $$userId;
    }

    public function getNextStatus()
    {

    }

    public function getAction()
    {

    }
}

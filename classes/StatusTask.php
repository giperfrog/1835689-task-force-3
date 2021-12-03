<php?

class StatusTask
{
    const STATUS_NEW='new';
    const STATUS_CANCEL='cancelled';
    const STATUS_IN_WORK='in work';
    const STATUS_DONE='done';
    const STATUS_FAIL='failed';
    const ACTION_CANCEL='action cancel';
    const ACTION_RESPOND='action respond';
    const ACTION_DONE='action done';
    const ACTION_FAIL='action fail';

    privat $customerId;
    privat $contractorId;

    public $statusName = [
        'STATUS_NEW' => 'Новое',
        'STATUS_CANCEL' => 'Отменено',
        'STATUS_IN_WORK' => 'В работе',
        'STATUS_DONE' => 'Выполнено',
        'STATUS_FAIL' => 'Провалено'
        ]

    public $actionName = [
        'ACTION_CANCEL' => 'Отменить задание',
        'ACTION_RESPOND' => 'Откликнуться на задание',
        'ACTION_DONE' => 'Выполнить задание',
        'ACTION_FAIL' => 'Отказаться от задания'
        ];

    public function __construct(int $customerId, int $contractorId) {
        $this->customerId = $customerId;
        $this->contractorId = $contractorId;
    }

    public function getNextStatus($action)
    {
        if ($action = 'ACTION_CANCEL') {
            return $statusName['STATUS_CANCEL'];
        }
        if ($action = 'ACTION_RESPOND') {
            return $statusName['STATUS_IN_WORK'];
        }
        if ($action = 'ACTION_DONE') {
            return $statusName['STATUS_DONE'];
        }
        if ($action = 'ACTION_FAIL') {
            return $statusName['STATUS_FAIL'];
        }
        else
        {
            return $statusName['STATUS_NEW'];
        }
    }

    public function getAction()
    {
        $current_state = $this->getNextStatus();
        switch ($current_state) {
            case 'Новое':
                return ($actionName['ACTION_CANCEL'] && $actionName['ACTION_RESPOND']);
            case 'В работе':
                return ($actionName['ACTION_DONE'] && $actionName['ACTION_FAIL']);
        }
    }
}

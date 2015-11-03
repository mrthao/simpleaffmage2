<?php


namespace Magestore\Dailydeal\Controller\Adminhtml\Dailydeal;

class NewAction extends \Magestore\Dailydeal\Controller\Adminhtml\Dailydeal
{
    public function execute()
    {
        $this->_forward('edit');
    }
}

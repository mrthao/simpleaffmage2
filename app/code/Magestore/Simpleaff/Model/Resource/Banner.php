<?php
namespace Magestore\Simpleaff\Model\Resource;

class Banner extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('simpleaffiliate_banner', 'banner_id');
    }
}

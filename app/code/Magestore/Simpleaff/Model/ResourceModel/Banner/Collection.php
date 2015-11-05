<?php
/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Giftvoucher
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
namespace Magestore\Simpleaff\Model\ResourceModel\Banner;

class Collection extends \Magestore\Simpleaff\Model\ResourceModel\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magestore\Simpleaff\Model\Banner', 'Magestore\Simpleaff\Model\ResourceModel\Banner');
    }
	/**
     * Returns pairs identifier - title for unique identifiers
     * and pairs identifier|page_id - title for non-unique after first
     *
     * @return array
     */
    public function toOptionIdArray()
    {
        $res = [];
        $existingIdentifiers = [];
        foreach ($this as $item) {
            $identifier = $item->getData('identifier');

            $data['value'] = $identifier;
            $data['label'] = $item->getData('title');

            if (in_array($identifier, $existingIdentifiers)) {
                $data['value'] .= '|' . $item->getData('banner_id');
            } else {
                $existingIdentifiers[] = $identifier;
            }

            $res[] = $data;
        }

        return $res;
    }
}
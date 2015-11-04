<?php
namespace Magestore\Bibabies\Controller\Adminhtml\Giftcard;

class Email extends \Magento\Backend\App\Action
{
	const XML_PATH_SEND_GIFTCARD_EMAIL_TEMPLATE = 'bigbabies_settings/giftcard_settings/gift_card_template';
	const XML_PATH_SEND_GIFTCARD_EMAIL_IDENTITY = 'bigbabies_settings/giftcard_settings/gift_card_identity';
	
	public function execute()
	{
		$giftcode = $this->getRequest()->getParam('gift_code');
		$collection = $this->_objectManager->create('Magestore\Bigbabies\Model\Giftcard\Resource\Code\Collection')->addFieldToFilter('giftcode',$giftcode);
		$model = $collection->getFirstItem();
		if($model->getId()){
			$customerName = $model->getCustomerName();
			$customerEmail = $model->getCustomerEmail();
			$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder
                ->setTemplateIdentifier($this->scopeConfig->getValue(self::XML_PATH_SEND_GIFTCARD_EMAIL_TEMPLATE, $storeScope))
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId(),
                    ]
                )
                ->setFrom($this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope))
                ->addTo($customerEmail,$customerName, $storeScope))
                ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(
                __('Sending email success.')
            );
            $this->_redirect('*/*/');
            return;
		}
		return $this;
	}
}
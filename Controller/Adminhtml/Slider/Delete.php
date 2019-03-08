<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Controller\Adminhtml\Slider;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slider_delete');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('slider_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$id) {
            // display error message
            $this->messageManager->addError(__('We can\'t find slider to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }

        try {
            /* @var \Scandiweb\Slider\Model\Slider $model */
            $model = $this->_objectManager->create('Scandiweb\Slider\Model\Slider');
            $model->load($id);
            $model->delete();

            $this->messageManager->addSuccess(__('The slider has been deleted.'));

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['slider_id' => $id]);
        }
    }
}

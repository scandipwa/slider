<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Controller\Adminhtml\Map;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::map_delete');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('map_id');
        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$id) {
            // display error message
            $this->messageManager->addError(__('We can\'t find the map to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }

        try {
            /* @var \Scandiweb\Slider\Model\Map $model */
            $model = $this->_objectManager->create('Scandiweb\Slider\Model\Map');
            $model->load($id);
            $model->delete();

            $this->messageManager->addSuccess(__('The map has been deleted.'));

            return $resultRedirect->setPath('slideradmin/slide/edit', ['slide_id' => $model->getSlideId()]);
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['map_id' => $id]);
        }
    }
}

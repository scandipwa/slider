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

class Save extends \Magento\Backend\App\Action
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::map_save');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();

        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            /* @var $model \Scandiweb\Slider\Model\Map */
            $model = $this->_objectManager->create('Scandiweb\Slider\Model\Map');

            $id = $this->getRequest()->getParam('map_id');
            if ($id) {
                $model->load($id);
            }

            $idPath = explode('/', str_replace('product/', '', $data['selected_product']));
            $data['product_id'] = $idPath[0];

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Map successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['map_id' => $model->getMapId(), '_current' => true]);
                }

                return $resultRedirect->setPath('slideradmin/map/edit', ['map_id' => $model->getId()]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the image map.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['map_id' => $this->getRequest()->getParam('map_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}

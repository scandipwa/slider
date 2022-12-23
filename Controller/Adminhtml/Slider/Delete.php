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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\CouldNotDeleteException;
use Scandiweb\Slider\Api\SliderRepositoryInterface;

class Delete extends Action
{
    /**
     * @var SliderRepositoryInterface
     */
    protected $sliderRepository;

    /**
     * @param Context $context
     * @param SliderRepositoryInterface $sliderRepository
     */
    public function __construct(
        Context $context,
        SliderRepositoryInterface $sliderRepository
    ) {
        parent::__construct($context);

        $this->sliderRepository = $sliderRepository;
    }

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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slider_id');

        if (!$id) {
            // display error message
            $this->messageManager->addErrorMessage(__('We can\'t find slider to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $this->sliderRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('The slider has been deleted.'));

            return $resultRedirect->setPath('*/*/');
        } catch (CouldNotDeleteException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['slider_id' => $id]);
        }
    }
}

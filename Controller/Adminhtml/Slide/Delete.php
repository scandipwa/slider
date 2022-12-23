<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Scandiweb\Slider\Api\SlideRepositoryInterface;

class Delete extends Action
{
    /**
     * @var SlideRepositoryInterface
     */
    protected $slideRepository;

    /**
     * @param Context $context
     * @param SlideRepositoryInterface $slideRepository
     */
    public function __construct(
        Context $context,
        SlideRepositoryInterface $slideRepository
    ) {
        parent::__construct($context);

        $this->slideRepository = $slideRepository;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slide_delete');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('slide_id');

        if (!$id) {
            // display error message
            $this->messageManager->addErrorMessage(__('We can\'t find slide to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $slide = $this->slideRepository->get($id);
            $this->slideRepository->delete($slide);
            $this->messageManager->addSuccessMessage(__('The slide has been deleted.'));

            return $resultRedirect->setPath('slideradmin/slider/edit', [
                'slider_id' => $slide->getSliderId()
            ]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', ['slide_id' => $id]);
        }
    }
}

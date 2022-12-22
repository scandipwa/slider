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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Scandiweb\Slider\Api\MapRepositoryInterface;

class Delete extends Action
{
    /**
     * @var MapRepositoryInterface
     */
    protected $mapRepository;

    /**
     * @param Context $context
     * @param MapRepositoryInterface $mapRepository
     */
    public function __construct(
        Context $context,
        MapRepositoryInterface $mapRepository
    ) {
        parent::__construct($context);

        $this->mapRepository = $mapRepository;
    }

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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('map_id');

        if (!$id) {
            // display error message
            $this->messageManager->addErrorMessage(__('We can\'t find the map to delete.'));
            // go to grid
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $map = $this->mapRepository->get($id);
            $this->mapRepository->delete($map);
            $this->messageManager->addSuccessMessage(__('The map has been deleted.'));

            return $resultRedirect->setPath('slideradmin/slide/edit', [
                'slide_id' => $map->getSlideId()
            ]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', ['map_id' => $id]);
        }
    }
}

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
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Model\MapFactory;

class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var MapRepositoryInterface
     */
    protected $mapRepository;

    /**
     * @var MapFactory
     */
    protected $mapFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param MapRepositoryInterface $mapRepository
     * @param MapFactory $mapFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MapRepositoryInterface $mapRepository,
        MapFactory $mapFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->mapRepository = $mapRepository;
        $this->mapFactory = $mapFactory;
    }

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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParams();

        if ($data) {
            $id = $this->getRequest()->getParam('map_id');
            $map = null;

            if ($id) {
                try {
                    /** @var \Scandiweb\Slider\Model\Map $map */
                    $map = $this->mapRepository->get($id);
                } catch (NoSuchEntityException $e) {
                    /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
                    $this->messageManager->addErrorMessage(__('This map no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                /** @var \Scandiweb\Slider\Model\Map $map */
                $map = $this->mapFactory->create();
            }

            $idPath = explode('/', str_replace('product/', '', $data['selected_product']));
            $data['product_id'] = $idPath[0];
            $map->setData($data);

            try {
                $this->mapRepository->save($map);
                $this->messageManager->addSuccessMessage(__('Map successfully saved.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [
                        'map_id' => $map->getId(),
                        '_current' => true
                    ]);
                }

                return $resultRedirect->setPath('slideradmin/map/edit', [
                    'map_id' => $map->getId()
                ]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e,
                    __('Something went wrong while saving the image map.')
                );
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', [
                'map_id' => $this->getRequest()->getParam('map_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}

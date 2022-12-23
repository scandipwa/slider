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
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Slider\Api\MapRepositoryInterface;
use Scandiweb\Slider\Model\MapFactory;

class Edit extends Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

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
     * @param Registry $registry
     * @param MapRepositoryInterface $mapRepository
     * @param MapFactory $mapFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        MapRepositoryInterface $mapRepository,
        MapFactory $mapFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
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
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }

    /**
     * Edit slider
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('map_id');
        $map = null;

        if ($id) {
            try {
                /** @var \Scandiweb\Slider\Model\Map $map */
                $map = $this->mapRepository->get($id);
            } catch (NoSuchEntityException $e) {
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This map no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }
        } else {
            /** @var \Scandiweb\Slider\Model\Map $map */
            $map = $this->mapFactory->create();
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $map->setData($data);
        }

        if ($slideId = $this->_request->getParam('slide_id')) {
            $map->setSlideId($slideId);
        }

        $this->_coreRegistry->register('map', $map);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();

        return $resultPage;
    }
}

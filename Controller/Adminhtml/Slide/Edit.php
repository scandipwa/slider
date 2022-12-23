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
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Slider\Api\SlideRepositoryInterface;
use Scandiweb\Slider\Model\SlideFactory;

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
     * @var SlideRepositoryInterface
     */
    protected $slideRepository;

    /**
     * @var SlideFactory
     */
    protected $slideFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param SlideRepositoryInterface $slideRepository
     * @param SlideFactory $slideFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        SlideRepositoryInterface $slideRepository,
        SlideFactory $slideFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->slideRepository = $slideRepository;
        $this->slideFactory = $slideFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slide_save');
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
        $id = $this->getRequest()->getParam('slide_id');
        $slide = null;

        if ($id) {
            try {
                /** @var \Scandiweb\Slider\Model\Slide $slide */
                $slide = $this->slideRepository->get($id);
            } catch (NoSuchEntityException $e) {
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This slide no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }
        } else {
            /** @var \Scandiweb\Slider\Model\Slide $slide */
            $slide = $this->slideFactory->create();
        }

        $data = $this->_getSession()->getFormData(true);

        if (!empty($data)) {
            $slide->setData($data);
        }

        if ($sliderId = $this->_request->getParam('slider_id')) {
            $slide->setSliderId($sliderId);
        }

        $this->_coreRegistry->register('slide', $slide);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();

        return $resultPage;
    }
}

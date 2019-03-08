<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slide;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /* @var \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $_slideCollection */
    protected $_slideCollection;

    /* @var \Magento\Framework\Registry $_registry */
    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $slideCollection,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_slideCollection = $slideCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Slides Found'));
        $this->setId('slideGrid');
        $this->setUseAjax(true);
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slide\Edit\Tab\Slide
     */
    protected function _prepareCollection()
    {
        $this->_slideCollection
            ->addSliderFilter($this->_request->getParam('slider_id'));

        $this->setCollection($this->_slideCollection);

        return parent::_prepareCollection();
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slide\Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'slide_id',
            [
                'header' => __('Slide Id'),
                'index' => 'slide_id',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'images',
            [
                'header' => __('Images'),
                'index' => 'images',
                'filter' => false,
                'renderer' => 'Scandiweb\Slider\Block\Adminhtml\Grid\Column\Image'
            ]
        );

        $this->addColumn(
            'start_time',
            [
                'header' => __('Starting time'),
                'type' => 'datetime',
                'index' => 'start_time',
                'class' => 'xxx',
                'width' => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'end_time',
            [
                'header' => __('Ending time'),
                'type' => 'datetime',
                'index' => 'end_time',
                'class' => 'xxx',
                'width' => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'options' => [0 => __('Disabled'), 1 => __('Enabled')],
                'search' => 0
            ]
        );

        return $this;
    }

    /**
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'slideradmin/slide/edit',
            ['slide_id' => $row->getId()]
        );
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        if (!$this->_request->getParam('slider_id')) {

            return __('Please save the slider before adding slides.');
        }

        return parent::toHtml();
    }
}

<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Map;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /* @var \Scandiweb\Slider\Model\ResourceModel\Map\Collection $_mapCollection */
    protected $_mapCollection;

    /* @var \Magento\Framework\Registry $_registry */
    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Scandiweb\Slider\Model\ResourceModel\Map\Collection $mapCollection,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_mapCollection = $mapCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Maps Found'));
        $this->setId('mapGrid');
        $this->setUseAjax(true);
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Map\Grid
     */
    protected function _prepareCollection()
    {
        $this->_mapCollection
            ->addSlideFilter($this->_request->getParam('slide_id'));

        $this->setCollection($this->_mapCollection);

        return parent::_prepareCollection();
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Map\Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'map_id',
            [
                'header' => __('Map Id'),
                'index' => 'map_id',
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
            'slideradmin/map/edit',
            ['map_id' => $row->getId()]
        );
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        if (!$this->_request->getParam('slide_id')) {

            return __('Please save the slide before adding image maps.');
        }

        return parent::toHtml();
    }
}

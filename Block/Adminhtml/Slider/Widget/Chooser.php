<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slider\Widget;

use Magento\Backend\Block\Widget\Grid;
use Magento\Backend\Block\Widget\Grid\Column;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Chooser extends Extended
{
    /* @var \Scandiweb\Slider\Model\ResourceModel\Slider\CollectionFactory $_collectionFactory */
    protected $_collectionFactory;

    /* @var \Scandiweb\Slider\Model\SliderFactory $_sliderFactory */
    protected $_sliderFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Scandiweb\Slider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory,
        \Scandiweb\Slider\Model\SliderFactory $sliderFactory,
        array $data
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_sliderFactory = $sliderFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setDefaultSort('slider_id');
        $this->setUseAjax(true);
    }

    /**
     * Prepare chooser element HTML
     *
     * @param  AbstractElement $element Form Element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $uniqId = $this->mathRandom->getUniqueHash($element->getId());
        $sourceUrl = $this->getUrl(
            'slideradmin/slider_widget/chooser',
            ['uniq_id' => $uniqId, 'use_massaction' => false]
        );

        $chooser = $this->getLayout()->createBlock(
            'Magento\Widget\Block\Adminhtml\Widget\Chooser'
        )->setElement(
            $element
        )->setConfig(
            $this->getConfig()
        )->setFieldsetId(
            $this->getFieldsetId()
        )->setSourceUrl(
            $sourceUrl
        )->setUniqId(
            $uniqId
        );

        if ($element->getValue()) {
            $slider = $this->_sliderFactory->create()->load($element->getValue());
            if ($slider->getId()) {
                $chooser->setLabel($this->escapeHtml($slider->getTitle()));
            }
        }
        $element->setData('after_element_html', $chooser->toHtml());

        return $element;
    }

    /**
     * @return string
     */
    public function getRowClickCallback()
    {
        $chooserJsObject = $this->getId();
        $js = '
            function (grid, event) {
                var trElement = Event.findElement(event, "tr");
                var sliderId = trElement.down("td").innerHTML.replace(/^\s+|\s+$/g,"");
                var sliderTitle = trElement.down("td").next().innerHTML;
                ' .
            $chooserJsObject .
            '.setElementValue(sliderId);
                ' .
            $chooserJsObject .
            '.setElementLabel(sliderTitle);
                ' .
            $chooserJsObject .
            '.close();
            }
        ';

        return $js;
    }

    /**
     * Prepare products collection, defined collection filters (category, product type)
     *
     * @return Extended
     */
    protected function _prepareCollection()
    {
        /* @var $collection \Scandiweb\Slider\Model\ResourceModel\Slider\Collection */
        $collection = $this->_collectionFactory->create();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns for products grid
     *
     * @return Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'chooser_id',
            [
                'header' => __('ID'),
                'index' => 'slider_id',
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
                'options' => [0 => __('Disabled'), 1 => __('Enabled')]
            ]
        );

        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'index' => 'position',
            ]
        );

        return parent::_prepareColumns();
    }
}

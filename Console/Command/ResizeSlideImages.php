<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Raivis Dejus <info@scandiweb.com>
 * @copyright   Copyright (c) 2018 Scandiweb, Ltd (https://scandiweb.com)
 */
namespace Scandiweb\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Scandiweb\Slider\Model\ResourceModel\Slide\Collection;
use Scandiweb\Slider\Model\Slide;

class ResizeSlideImages extends Command
{
    /**
     * @var Collection
     */
    private $slideCollection;
    /**
     * @var Slide
     */
    private $slideModel;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Collection $slideCollection
     * @param Slide $slideModel
     * @param Filesystem $filesystem
     */
    public function __construct(
        Collection $slideCollection,
        Slide $slideModel,
        Filesystem $filesystem
    ) {
        $this->slideCollection = $slideCollection;
        $this->slideModel = $slideModel;
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('scandiweb:slider:resize-slide-images')
            ->setDescription('Will resize images for use in image tag srcset');

        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Starting image resize for all slide images</info>');

        $mediaDir = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $slides = $this->slideCollection->load();


        foreach ($slides as $slide) {
            $output->writeln('Processing slide ID:' . $slide->getId());

            $this->slideModel->prepareImagesForSrcset($mediaDir . $slide->getImage());

            // Will process optional images
            if($slide->getImage2()) {
                $this->slideModel->prepareImagesForSrcset($mediaDir . $slide->getImage2());
            }

            if($slide->getImage3()) {
                $this->slideModel->prepareImagesForSrcset($mediaDir . $slide->getImage3());
            }
        }


        $output->writeln('<info>All slide images resized!</info>');
    }
}

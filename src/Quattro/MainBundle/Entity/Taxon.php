<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Quattro\MainBundle\Entity;

use Sylius\Bundle\TaxonomiesBundle\Model\Taxon as BaseTaxon;
use Doctrine\Common\Collections\ArrayCollection;

class Taxon extends BaseTaxon implements TaxonInterface
{

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var ArrayCollection
     */
    protected $business;

    /**
     * Images.
     *
     * @var Collection
     */
    protected $images;

    public function __construct()
    {
        parent::__construct();

        $this->createdAt = new \DateTime();
        $this->business = new ArrayCollection();

        $this->images = new ArrayCollection();
    }


    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * {@inheritdoc}
     */
    public function setBusiness($business)
    {
        $this->business = $business;
    }

    /**
    * {@inheritdoc}
    */
    public function hasImage(ImageInterface $image)
    {
       return $this->images->contains($image);
    }

    /**
    * {@inheritdoc}
    */
    public function getImages()
    {
       return $this->images;
    }

    /**
    * {@inheritdoc}
    */
    public function addImage(ImageInterface $image)
    {
       if (!$this->hasImage($image)) {
           $this->images->add($image);
       }
    }

    public function getImage()
    {
        return ($this->images->isEmpty())? '': $this->images->first()->getPath();
    }

    /**
    * {@inheritdoc}
    */
    public function removeImage(ImageInterface $image)
    {
       $this->images->removeElement($image);
    }

    public function setImages($images)
    {
       $images = (is_array($images)) ? new ArrayCollection($images) : $images;
       foreach ($this->images as $image) {
           $this->removeImage($image);
       }
       foreach ($images as $image) {
           $this->addImage($image);
       }
    }
}
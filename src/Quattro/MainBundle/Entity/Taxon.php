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

class Taxon extends BaseTaxon implements TaxonInterface, ImageInterface
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
     * File
     *
     * @var \SplFileInfo
     */
    protected $file;

    /**
     * Path to file
     *
     * @var string
     */
    protected $path;

    public function __construct()
    {
        parent::__construct();

        $this->createdAt = new \DateTime();
        $this->business = new ArrayCollection();

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
       public function hasFile()
       {
           return null !== $this->file;
       }

       /**
        * {@inheritdoc}
        */
       public function getFile()
       {
           return $this->file;
       }

       /**
        * {@inheritdoc}
        */
       public function setFile(\SplFileInfo $file)
       {
           $this->file = $file;

           return $this;
       }

       /**
        * {@inheritdoc}
        */
       public function hasPath()
       {
           return null !== $this->path;
       }

       /**
        * {@inheritdoc}
        */
       public function getPath()
       {
           return $this->path;
       }

       /**
        * {@inheritdoc}
        */
       public function setPath($path)
       {
           $this->path = $path;

           return $this;
       }
}
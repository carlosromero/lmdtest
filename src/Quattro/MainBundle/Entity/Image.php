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

class Image implements ImageInterface
{
    const SERVER_PATH_TO_IMAGE_FOLDER = '/images/business';

    /**
     * Id
     *
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected  $title;

    /**
    * @var string
    */
    protected  $alt;

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

    /**
     * Creation date
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Update date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     *
     * @var Quattro\MainBundle\Entity\Business
     */
    protected $business;

    public function __construct()
    {
        $this->createdAt = new \DateTime();

    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
           if ($this->file) {
              $this->updatedAt = new \DateTime('now');
           }
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param \Quattro\MainBundle\Entity\Quattro\MainBundle\Entity\Business $business
     */
    public function setBusiness($business)
    {
        $this->business = $business;
    }

    /**
     * @return \Quattro\MainBundle\Entity\Quattro\MainBundle\Entity\Business
     */
    public function getBusiness()
    {
        return $this->business;
    }



}
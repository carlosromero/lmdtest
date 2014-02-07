<?php

namespace Quattro\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 */
class Tag
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
    * Price of the ink
    *
    * @var boolean
    */
    protected $hide;

    /**
    * Creation time.
    *
    * @var \DateTime
    */
    protected $createdAt;

    /**
    * Last update time.
    *
    * @var \DateTime
    */
    protected $updatedAt;

    /**
    * Deletion time.
    *
    * @var \DateTime
    */
    protected $deletedAt;

    public function __toString(){
       return $this->getName();
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    /**
    * {@inheritdoc}
    */
    public function getHide()
    {
       return $this->hide;
    }

    /**
    * {@inheritdoc}
    */
    public function setHide($hide)
    {
       $this->hide = $hide;
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
    }

    /**
    * {@inheritdoc}
    */
    public function isDeleted()
    {
       return null !== $this->deletedAt && new \DateTime() >= $this->deletedAt;
    }

    /**
    * {@inheritdoc}
    */
    public function getDeletedAt()
    {
       return $this->deletedAt;
    }

    /**
    * {@inheritdoc}
    */
    public function setDeletedAt(\DateTime $deletedAt)
    {
       $this->deletedAt = $deletedAt;
    }

    /**
    * Set slug
    *
    * @param string $slug
    * @return Tag
    */
    public function setSlug($slug)
    {
       $this->slug = $slug;

       return $this;
    }

    /**
    * Get slug
    *
    * @return string
    */
    public function getSlug()
    {
       return $this->slug;
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
    * Set name
    *
    * @param string $name
    * @return Tag
    */
    public function setName($name)
    {
    $this->name = $name;

    return $this;
    }

    /**
    * Get name
    *
    * @return string
    */
    public function getName()
    {
    return $this->name;
    }
}

<?php
/**
 * Created by 
 * User: karlos
 * Date: 06/02/14
 * Time: 00:01
 */

namespace Quattro\MainBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Bundle\ResourceBundle\Model\SoftDeletableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Business implements  SoftDeletableInterface, ImageInterface {
    /**
     * @var int
     */
    private  $id;
    /**
     * @var string
     */
    private $video;
    /**
     * @var string
     */
    private $video2;
    /**
     * @var string
     */
    private $shortDescription;
    /**
     * @var string
     */
    private $metaTitle;
    /**
     * @var string
     */
    private $metaKeywords;
    /**
     * @var string
     */
    private $metaDescription;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $slug;
    /**
     * @var string
     */
    private $description;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @var \DateTime
     */
    private $deletedAt;
    /**
     * @var string
     */
    private $hide;
    /**
     * @var ArrayCollection
     */
    private $tags;
    /**
     * @var ArrayCollection
     */
    private $taxons;
    /**
     * Images.
     *
     * @var Collection
     */
    protected $images;
    /**
     * @var string
     */
    protected $logo;
    /**
     * @var \SplFileInfo
     */
    protected $file;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     *
     * @Assert\Url()
     */
    private $web;
    /**
     * @var string
     */
    private $map;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $timeTable;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->taxons = new ArrayCollection();

        $this->createdAt = new \DateTime();

        $this->images = new ArrayCollection();
    }


    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $hide
     */
    public function setHide($hide)
    {
        $this->hide = $hide;
    }

    /**
     * @return string
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $taxons
     */
    public function setTaxons($taxons)
    {
        $this->taxons = $taxons;
    }

    /**
     * @return string
     */
    public function getTaxons()
    {
        return $this->taxons;
    }



    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video2
     */
    public function setVideo2($video2)
    {
        $this->video2 = $video2;
    }

    /**
     * @return string
     */
    public function getVideo2()
    {
        return $this->video2;
    }


    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }



    /**
     * Is item deleted?
     *
     * @return Boolean
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt && new \DateTime() >= $this->deletedAt;
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
    public function getImages($image = null)
    {
       if ($image) {
           return $this->images->get($this->images->indexOf($image));
       } else {
           return $this->images;
       }

    }

    /**
    * {@inheritdoc}
    */
    public function addImage(ImageInterface $image)
    {
       if (!$this->hasImage($image)) {
           $image->setBusiness($this);
           $this->images->add($image);
       }
    }

    /**
    * {@inheritdoc}
    */
    public function removeImage(ImageInterface $image)
    {
       $image->setBusiness(null);
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

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $map
     */
    public function setMap($map)
    {
        $this->map = $map;
    }

    /**
     * @return string
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $timeTable
     */
    public function setTimeTable($timeTable)
    {
        $this->timeTable = $timeTable;
    }

    /**
     * @return string
     */
    public function getTimeTable()
    {
        return $this->timeTable;
    }

    /**
     * @param string $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
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

}
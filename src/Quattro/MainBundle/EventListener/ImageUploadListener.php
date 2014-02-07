<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Quattro\MainBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Proxies\__CG__\Quattro\MainBundle\Entity\Taxon;
use Quattro\MainBundle\Entity\Business;
use Quattro\MainBundle\Entity\TaxonImage;
use Quattro\MainBundle\Uploader\ImageUploaderInterface;
use Sylius\Bundle\TaxonomiesBundle\Model\TaxonInterface;

class ImageUploadListener implements EventSubscriber
{
    protected $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Business) {
            $this->uploadBusinessImage($entity);
        } elseif ($entity instanceof TaxonInterface) {
            $this->uploadTaxon($entity);
        }
    }




    public function uploadBusinessImage($subject)
    {
        if (!$subject instanceof Business) {
            throw new \InvalidArgumentException('Business expected.');
        }

        $finalImages = array();
        foreach ($subject->getImages() as $image) {
            if (null === $image->getId() ) {
                if ($this->uploader->upload($image)) {
                    $finalImages[] = $image;
                }
            } else {
                $finalImages[] = $image;
            }
        }
        $subject->setImages($finalImages);
    }

    public function uploadTaxon($subject)
    {
        if (!$subject instanceof TaxonInterface) {
           throw new \InvalidArgumentException('Taxon expected.');
       }
        if ($subject->hasFile()) {
           $this->uploader->upload($subject);
        }
    }

    public function uploadTaxonImage($subject)
       {
           if (!$subject instanceof TaxonImage) {
               throw new \InvalidArgumentException('TaxonImage expected.');
           }

           if ($subject->hasFile()) {
               $this->uploader->upload($subject);
           }

       }

}

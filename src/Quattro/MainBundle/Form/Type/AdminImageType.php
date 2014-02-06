<?php
namespace Quattro\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class AdminImageType extends AbstractType
{
    public function getParent()
    {
        return 'file';
    }

    public function getName()
    {
        return 'admin_image';
    }
}
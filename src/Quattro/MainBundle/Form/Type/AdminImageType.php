<?php
namespace Quattro\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class AdminImageType extends AbstractType
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'file';
    }

    /**
    * Add the image_path option
    *
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       $resolver->setOptional(array('image_path'));
    }

    /**
    * Pass the image URL to the view
    *
    * @param FormView $view
    * @param FormInterface $form
    * @param array $options
    */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
       if (array_key_exists('image_path', $options)) {
           $parentData = $form->getParent()->getData();

           if (null !== $parentData) {
               $accessor = PropertyAccess::createPropertyAccessor();
               $imageUrl = $accessor->getValue($parentData, $options['image_path']);
           } else {
                $imageUrl = null;
           }

           // set an "image_url" variable that will be available when rendering this field
           $view->vars['image_url'] = $imageUrl;
       }
    }
}
<?php

namespace Quattro\MainBundle\Admin;

use Quattro\MainBundle\Form\Type\AdminImageType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ImageAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        if($this->hasParentFieldDescription()) { // this Admin is embedded
            // $getter will be something like 'getlogoImage'
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();

            // get hold of the parent object
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            $image = null;
            if ($parent) {
               // $image = $parent->$getter();
            } else {
                $image = null;
            }
        } else {
            $image = $this->getSubject();
        }

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getPath())) {
            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$webPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('title')
            ->add('alt')
            ->add('file','file', array('required' => false,'image_path' => 'path'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('alt')
            ->add('file')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }


}

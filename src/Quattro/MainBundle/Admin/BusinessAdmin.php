<?php

namespace Quattro\MainBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BusinessAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('hide')
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
            ->add('hide')
            ->add('_action', 'actions', array(
                'actions' => array(
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
        $formMapper
            ->add('hide', null, array('help'=>'business.hide.help'))
            ->add('name', null, array('help'=>'business.name.help'))
            ->add('taxons', null, array('property'=>'LaveledName','query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->andWhere('t.level>:level')
                        ->setParameter('level', 0)
                        ->orderBy('t.left', 'ASC');
                }))
            ->add('tags',null, array('required' => false, 'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                }))
            ->add('description', null, array('attr'=>array('rows'=>10),'help'=>'business.description.help'))
            ->add('address', null, array('attr'=>array('rows'=>5) ,'help'=>'business.address.help'))
            ->add('phone', null, array( 'help'=>'business.phone.help'))
            ->add('fax', null, array( 'help'=>'business.fax.help'))
            ->add('email', null, array( 'help'=>'business.email.help'))
            ->add('timeTable', null, array( 'help'=>'business.timetable.help'))
            ->add('web', null, array( 'help'=>'business.web.help'))
            ->add('file', 'file', array('required' => false, 'label' => 'Logotipo', 'image_path' => 'logo'))
            ->add('video', null, array('attr'=>array('rows'=>5), 'help'=>'business.video.help'))
            ->add('video2', null, array('attr'=>array('rows'=>5), 'help'=>'business.video.help'))
            ->add('images', 'sonata_type_collection', array('help'=>'business.images.help'), array(
                            'edit' => 'inline',
                            'inline' => 'table',
                            'sortable' => 'position',
                        ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('hide', null, array('help'=>'business.hide.help'))
               ->add('name', null, array('help'=>'business.name.help'))
               ->add('taxons')
               ->add('tags')
               ->add('description', null, array('attr'=>array('rows'=>10),'help'=>'business.description.help'))
               ->add('address', null, array('attr'=>array('rows'=>5) ,'help'=>'business.address.help'))
               ->add('phone', null, array( 'help'=>'business.phone.help'))
               ->add('timeTable', null, array( 'help'=>'business.timetable.help'))
               ->add('web', null, array( 'help'=>'business.web.help'))
               ->add('file', 'file', array('required' => false, 'label' => 'Logotipo', 'image_path' => 'logo'))
               ->add('video', null, array('attr'=>array('rows'=>5), 'help'=>'business.video.help'))
               ->add('video2', null, array('attr'=>array('rows'=>5), 'help'=>'business.video.help'))
               ->add('images', 'sonata_type_collection', array('help'=>'business.images.help'), array(
                               'edit' => 'inline',
                               'inline' => 'table',
                               'sortable' => 'position',
                           ))
        ;
    }

    public function prePersist($business) {
           $this->manageEmbeddedImageAdmins($business);

       }
       public function preUpdate($business) {

           $this->manageEmbeddedImageAdmins($business);
       }
       private function manageEmbeddedImageAdmins($business) {
           // Cycle through each field
           foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {

               // detect embedded Admins that manage Images
               if ($fieldDescription->getType() === 'sonata_type_collection' &&
                   ($associationMapping = $fieldDescription->getAssociationMapping()) &&
                   $associationMapping['targetEntity'] === 'Quattro\MainBundle\Entity\Image'
               ) {
                   $getter = 'get' . $fieldName;

                   /** @var Image $image */
                   $images = $business->$getter();
                   foreach ($images as $image) {
                       if ($image) {
                           $image->setBusiness($business);
                       }

                   }
               }
           }
       }
}

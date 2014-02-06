<?php
/**
 * Created by 
 * User: karlos
 * Date: 06/02/14
 * Time: 00:22
 */

namespace Quattro\MainBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TaxonAdmin extends Admin{

    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_sort_by' => 'left'  // name of the ordered field
                                 // (default = the model's id field, if any)

        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('taxonomy')
            ->add('parent')
            ->add('images', 'sonata_type_collection',
                 array(
                     'required' => false,
                     'by_reference' => false
                 ),
                 array(
                     'edit' => 'inline',
                     'inline' => 'table',
                     'allow_delete' => true
                 )
            )
        ;

    }


    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image',null, array('template' => 'QuattroMainBundle:Admin:list_image.html.twig'))
            ->addIdentifier('name',null, array('template' => 'QuattroMainBundle:Admin:list_taxon.html.twig'))

        ;
    }

    public function prePersist($taxon)
    {
        foreach ($taxon->getImages() as $image) {
            $image->setTaxon($taxon);
        }
    }

    public function preUpdate($taxon)
    {
        foreach ($taxon->getImages() as $image) {
            $image->setTaxon($taxon);
        }
    }
}
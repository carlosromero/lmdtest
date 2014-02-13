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
        $options = array('required' => false);
        if (($subject = $this->getSubject()) && $subject->getPath()) {
            $path = $subject->getPath();
            $options['help'] = '<img src="/media/image/' . $path . '" />';
        }
        $formMapper
            ->add('name')
            ->add('taxonomy')
            ->add('parent')
            ->add('file', 'file', $options)
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
            ->addIdentifier('name',null, array('template' => 'QuattroMainBundle:Admin:list_taxon.html.twig',
                                                'sortable' => 'left, name'
                                                )
                           )
            ->add('_action', 'actions', array(
                                        'actions' => array(
                                            'show' => array(),
                                            'edit' => array(),
                                            'delete' => array(),
                                            )
                                        )
            )
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->gt($query->getRootAlias() . '.level', ':level')
        );
        $query->setParameter('level', 0);
        return $query;
    }
}
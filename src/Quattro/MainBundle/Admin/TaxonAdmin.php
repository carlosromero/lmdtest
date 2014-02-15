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
        '_sort_by' => 'left',  // name of the ordered field
                                 // (default = the model's id field, if any)
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
        '_per_page' => '1000'
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $id = $subject->getId();

        $options = array('required' => false);
        if (($subject = $this->getSubject()) && $subject->getPath()) {
            $path = $subject->getPath();
            $options['help'] = '<img src="/media/image/' . $path . '" />';
        }
        $formMapper
            ->add('name')
            ->add('taxonomy')
            ->add('parent', null, array(
                                       'required'=>true
                                     , 'query_builder' => function($er) use ($id) {
                                           $qb = $er->createQueryBuilder('p');
                                           if ($id){
                                               $qb
                                                   ->where('p.id <> :id')
                                                   ->setParameter('id', $id)

                                               ;
                                           }
                                           $qb
                                               ->andwhere('p.level < 2')
                                               ->orderBy('p.parent, p.left', 'ASC');
                                           return $qb;
                                       }
                                   ))
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
            ->add('up', 'text', array('template' =>
                              'QuattroMainBundle:Admin:field_tree_up.html.twig', 'label'=>' '))
            ->add('down', 'text', array('template' =>
                   'QuattroMainBundle:Admin:field_tree_down.html.twig', 'label'=>' '))

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


      public function preRemove($object)
       {
           $em = $this->modelManager->getEntityManager($object);
           $repo = $em->getRepository("QuattroMainBundle:Taxon");
           $subtree = $repo->childrenHierarchy($object);
           /*
           foreach ($subtree AS $el){
               $menus = $em->getRepository('ShtumiPravBundle:AdditionalMenu')
                           ->findBy(array('page'=> $el['id']));
               foreach ($menus AS $m){
                   $em->remove($m);
               }
               $services = $em->getRepository('ShtumiPravBundle:Service')
                              ->findBy(array('page'=> $el['id']));
               foreach ($services AS $s){
                   $em->remove($s);
               }
               $em->flush();
           }
           */

           $repo->verify();
           $repo->recover();
           $em->flush();
       }

      public function postPersist($object)
       {
           $em = $this->modelManager->getEntityManager($object);
           $repo = $em->getRepository("QuattroMainBundle:Taxon");
           $repo->verify();
           $repo->recover();
           $em->flush();
       }

      public function postUpdate($object)
       {
           $em = $this->modelManager->getEntityManager($object);
           $repo = $em->getRepository("QuattroMainBundle:Taxon");
           $repo->verify();
           $repo->recover();
           $em->flush();
       }
}
<?php
/**
 * Created by 
 * User: karlos
 * Date: 15/02/14
 * Time: 15:28
 */

namespace Quattro\MainBundle\Controller;

use Lsw\SecureControllerBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaxonController extends Controller {

    /**
    * @Secure(roles="ROLE_USER")
    */
    public function upAction($taxon_id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('QuattroMainBundle:Taxon');
        $taxon = $repo->findOneById($taxon_id);
        if ($taxon->getParent()){
            $repo->moveUp($taxon);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    /**
    * @Secure(roles="ROLE_USER")
    */
    public function downAction($taxon_id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('QuattroMainBundle:Taxon');
        $taxon = $repo->findOneById($taxon_id);
        if ($taxon->getParent()){
            $repo->moveDown($taxon);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

}
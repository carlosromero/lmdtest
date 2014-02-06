<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Quattro\MainBundle\Entity;

use Quattro\MainBundle\Entity\Taxon;

class TaxonImage extends Image
{
    /**
     * @var Taxon
     */
    protected $taxon;

    /**
     * @param Taxon $taxon
     */
    public function setTaxon(Taxon $taxon)
    {
        $this->taxon = $taxon;
    }

    /**
     * @return Taxon
     */
    public function getTaxon()
    {
        return $this->taxon;
    }


}
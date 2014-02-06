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

use Doctrine\Common\Collections\Collection;
use Sylius\Bundle\TaxonomiesBundle\Model\TaxonInterface as VariableTaxonInterface;

/**
 * Taxon interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface TaxonInterface extends VariableTaxonInterface
{
    /**
     * Get business.
     *
     * @return Collection|ProductInterface[]
     */
    public function getBusiness();

    /**
     * Set business.
     *
     * @param ProductInterface[] $business
     */
    public function setBusiness($business);
}
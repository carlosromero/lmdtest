<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Quattro\MainBundle\Uploader;

use Gaufrette\Filesystem;
use Quattro\MainBundle\Entity\ImageInterface;

class ImageUploader implements ImageUploaderInterface
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(ImageInterface $image, $fieldName = 'Path')
    {
        if (!$image->hasFile()) {
            //throw new \InvalidArgumentException('The given image has no file attached.');
            return false;
        }
        $fieldName = ucfirst ($fieldName);
        $getter = 'get'.$fieldName;
        $setter = 'set'.$fieldName;
        if (null !== $image->$getter()) {
            $this->remove($image->$getter());
        }

        do {
            $hash = md5(uniqid(mt_rand(), true));
            $path = $this->expandPath($hash.'.'.$image->getFile()->guessExtension());
        } while ($this->filesystem->has($path));

        $image->$setter($path);

        return $this->filesystem->write(
            $image->$getter(),
            file_get_contents($image->getFile()->getPathname())
        );
    }

    public function remove($path)
    {
        return $this->filesystem->delete($path);
    }

    private function expandPath($path)
    {
        return sprintf(
            '%s/%s/%s',
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }
}

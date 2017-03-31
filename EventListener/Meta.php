<?php
/**
 * Created by PhpStorm.
 * User: maxence
 * Date: 23/05/2016
 * Time: 10:13
 */

namespace Mdespeuilles\MetaBundle\EventListener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Meta
{
    /**
     * @var ContainerInterface $containerInterface
     */
    private $containerInterface;

    /**
     * @var RequestStack $requestStack
     */
    private $requestStack;

    public function __construct(ContainerInterface $containerInterface, RequestStack $requestStack)
    {
        $this->containerInterface = $containerInterface;
        $this->requestStack = $requestStack;
    }

    public function setMeta() {
        $request = $this->requestStack->getCurrentRequest();
        $url = $request->getUri();
        $url_array = parse_url($url);
        $path = str_replace("/app_dev.php", "", $url_array["path"]);

        /* @var \Mdespeuilles\MetaBundle\Entity\Meta $meta */
        $meta = $this->containerInterface->get('mdespeuilles.entity.meta')->findOneBy([
            'url' => $path,
            'language' => $request->getLocale()
        ]);

        $seoPage = $this->containerInterface->get('sonata.seo.page');

        if ($meta) {
            $seoPage->setTitle($meta->getTitle());
            $seoPage->addMeta('name', 'description', $meta->getDescription());
            $seoPage->addMeta('property', 'og:title', $meta->getOgTitle());
            $seoPage->addMeta('property', 'og:url',  $request->getUri());
            $seoPage->addMeta('property', 'og:description', $meta->getOgDescription());
            $helper = $this->containerInterface->get('vich_uploader.templating.helper.uploader_helper');
            $path = $helper->asset($meta, 'ogImageFile');
            if ($path) {
                $seoPage->addMeta('property', 'og:image', $url_array["scheme"]."://".$url_array["host"] . $path);
            }
        }
    }
}

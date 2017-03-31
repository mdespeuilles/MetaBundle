<?php

namespace Mdespeuilles\MetaBundle\Controller;

use Mdespeuilles\MetaBundle\Entity\Meta;
use Mdespeuilles\MetaBundle\Form\MetaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MetaController extends Controller
{
    public function metaAction(Request $request)
    {
        $url = $request->getUri();
        $url_array = parse_url($url);
        $path = str_replace("/app_dev.php", "", $url_array["path"]);
        $language = $request->getLocale();

        /* @var \Mdespeuilles\MetaBundle\Entity\Meta $meta */
        $meta = $this->get('mdespeuilles.entity.meta')->findOneBy([
            'url' => $path,
            'language' => $request->getLocale()
        ]);

        $form = null;

        if ($meta) {
            $form = $this->createForm(MetaType::class, $meta, [
                'action' => $this->generateUrl("meta_form_edit", [
                    "metaId" => $meta->getId()
                ])
            ]);
        }
        else {
            $meta = new Meta();
            $meta->setUrl($path);
            $meta->setLanguage($language);
            $form = $this->createForm(MetaType::class, $meta, [
                'action' => $this->generateUrl("meta_form_add")
            ]);
        }

        return $this->render('MdespeuillesMetaBundle:Meta:meta_form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addMetaAction(Request $request) {
        $meta = new Meta();
        $form = $this->createForm(MetaType::class, $meta);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meta);
            $em->flush();
        }

        $prefix = ($this->get('kernel')->getEnvironment() == "dev") ? "/app_dev.php" : null;

        return $this->redirect($prefix.$meta->getUrl());
    }

    public function editMetaAction(Request $request, $metaId) {

        /* @var \Mdespeuilles\MetaBundle\Entity\Meta $meta */
        $meta = $this->get('mdespeuilles.entity.meta')->find($metaId);

        $form = $this->createForm(MetaType::class, $meta);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meta);
            $em->flush();
        }

        $prefix = ($this->get('kernel')->getEnvironment() == "dev") ? "/app_dev.php" : null;

        return $this->redirect($prefix.$meta->getUrl());
    }

}

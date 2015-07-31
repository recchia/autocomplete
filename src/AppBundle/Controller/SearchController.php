<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Form\SearchType;
use AppBundle\Form\JqueryType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Search controller.
 *
 * @Route("/search")
 */
class SearchController extends Controller
{
    /**
     * @Route("/", name="search")
     * @Template()
     */
    public function indexAction()
    {
        $form   = $this->createForm(new SearchType(), null, [
            'action' => '',
            'method' => 'POST'
        ]);

        return array(
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/person_search", name="person_search")
     * @Template()
     *
     * @param Request $request
     *
     * @return array
     */
    public function searchPersonAction(Request $request)
    {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('AppBundle:Person')->findLikeFullname($q);

        return array('results' => $results);
    }

    /**
     * @Route("/person_get", name="person_get")
     *
     * @param $id
     *
     * @return Response
     */
    public function getPersonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AppBundle:Person')->find($id);

        return new Response($book->getFullname());
    }

    /**
     * @Route("/jquery", name="jquery")
     * @Template()
     */
    public function jqueryAction()
    {
        $form   = $this->createForm(new JqueryType(), null, [
            'action' => '',
            'method' => 'POST'
        ]);

        return array(
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/jquery_search/{phrase}", name="jquery_search")
     *
     * @param string $phrase
     *
     * @return JsonResponse
     */
    public function searchJqueryAction($phrase)
    {
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('AppBundle:Person')->findLikeFullnameArray($phrase);

        return new JsonResponse($results);
    }

}

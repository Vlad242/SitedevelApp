<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Episode;
use AppBundle\Entity\Serial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="show_serials")
     */
    public function showSerialsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serials = $em->getRepository('AppBundle:Serial')->findAll();
        return $this->render('@App/default/showSerials.html.twig', [
            'serials' => $serials,
        ]);
    }


    /**
     * @Route("/season/{serial}", name="show_seasons")
     * @param Request $request
     * @param Serial $serial
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSeasonBySerialAction(Request $request, Serial $serial)
    {
        $em = $this->getDoctrine()->getManager();
        $seasons = $em->getRepository('AppBundle:Season')->findBy([
            'serial' => $serial
        ]);
        return $this->render('@App/default/showSeasons.html.twig', [
            'seasons' => $seasons,
            'serial' => $serial->getName()
        ]);
    }

    /**
     * @Route("/episode/{episode}", name="show_episode_detail")
     * @param Request $request
     * @param Episode $episode
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEpisodeByIdAction(Request $request, Episode $episode)
    {
        $em = $this->getDoctrine()->getManager();
        $episode = $em->getRepository('AppBundle:Episode')->findOneBy([
            'id' => $episode,
        ]);
        return $this->render('@App/default/showEpisode.html.twig', [
            'episode' => $episode,
        ]);
    }

}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Episode;
use AppBundle\Entity\Season;
use AppBundle\Entity\Serial;
use AppBundle\Form\NewEpisodeType;
use AppBundle\Form\NewSeasonType;
use AppBundle\Form\NewSerialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\FileUploader;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_room")
     */
    public function showListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $serials = $em->getRepository('AppBundle:Serial')->findAll();
        return $this->render('@App/Admin/adminView.html.twig', [
            'serials' => $serials,
        ]);
    }

    /**
     * @Route("/new_serial", name="new_serial")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newSerialAction(Request $request, FileUploader $fileUploader)
    {
        $serial = new Serial();
        $form = $this->createForm(NewSerialType::class, $serial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $serial->getImagePath();
            $fileName = $fileUploader->upload($image);
            $serial->setImagePath($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($serial);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_room'));
        }
        return $this->render('@App/Admin/adminNewSerial.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new_season/{serial}", name="new_season")
     * @param Request $request
     * @param Serial $serial
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newSeasonBySerialAction(Request $request, Serial $serial)
    {
        $season = new Season();
        $form = $this->createForm(NewSeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $season->setSerial($serial);
            $em = $this->getDoctrine()->getManager();
            $em->persist($season);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_room'));
        }
        return $this->render('@App/Admin/adminNewSeason.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new_episode/{season}", name="new_episode")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param Season $season
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newEpisodeBySeasonAction(Request $request, FileUploader $fileUploader, Season $season)
    {
        $episode = new Episode();
        $form = $this->createForm(NewEpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $episode->getImagePath();
            $fileName = $fileUploader->upload($image);
            $episode->setImagePath($fileName);
            $episode->setSeason($season);
            $em = $this->getDoctrine()->getManager();
            $em->persist($episode);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_room'));
        }
        return $this->render('@App/Admin/adminNewEpisode.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}

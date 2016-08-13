<?php

namespace Alyya\JobeetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Alyya\JobeetBundle\Entity\Job;
use Alyya\JobeetBundle\Form\JobType;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // categories with at least on active job;
        $categories = $em->getRepository('AlyyaJobeetBundle:Category')->getWithJobs();
        foreach ($categories as $category ){
            $category->setActiveJobs($em->getRepository('AlyyaJobeetBundle:Job')->getActiveJobs($category->getId(),$this->container->getParameter('max_job_on_homepage')));
            $category->setMoreJobs($em->getRepository('AlyyaJobeetBundle:Job')->countActiveJobs($category->getId()) - $this->container->getParameter('max_job_on_homepage'));
        }
        return $this->render('job/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new Job entity.
     *
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm('Alyya\JobeetBundle\Form\JobType', $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('alyya_job_preview', array('token' => $job->getToken() , 'company' => $job->getCompanySlug(),'location' => $job->getLocationSlug(),'position' => $job->getPositionSlug() ));
        }

        return $this->render('job/new.html.twig', array(
            'job' => $job,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction(Job $job)
    {
        //return $this->getDoctrine()->getEntityManager()->getRepository('AlyyaJobeetBundle:Job')->getActiveJob($job->getId());
        //dump($job);dump($job->isExpired());die();
        if($job->isExpired()){
            throw $this->createNotFoundException('This job is expired and does not exist any more');
        }
        $deleteForm = $this->createDeleteForm($job);

        return $this->render('job/show.html.twig', array(
            'job' => $job,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a Job entity.
     *
     */
    public function previewAction($token)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->getRepository('AlyyaJobeetBundle:Job')->findOneByToken($token);
        //dump($job);
        if (!$job){
            throw $this->createNotFoundException('This page does not exist ');
        }
        $deleteForm = $this->createDeleteForm($job);
        $publishForm = $this->createPublishForm($job);
        $extendForm = $this->createExtendForm($job);

        return $this->render('job/show.html.twig',
            array('job' => $job ,
                'delete_form' => $deleteForm->createView() ,
                'publish_form' => $publishForm->createView(),
                'extend_form' => $extendForm->createView()
            ));
    }

    public function publishAction (Request $request ,$token){
         $em = $this->getDoctrine()->getManager();
         $job =   $em->getRepository("AlyyaJobeetBundle:Job")->findOneByToken($token);
        if(!$job){
            throw $this->createNotFoundException();
        }
        $publishForm = $this->createPublishForm($job);
        $publishForm->handleRequest($request);

        if($publishForm->isSubmitted() && $publishForm->isValid()){
            $job->publish();
            dump($job);
            $em->persist($job);
            $em->flush();
            $this->addFlash('notice', 'This job is now published for 30 days');

        }
        return $this->redirectToRoute('alyya_job_preview',
            array(
                'token' => $job->getToken() ,
                'company' => $job->getCompanySlug(),
                'location' => $job->getLocationSlug(),
                'position' => $job->getPositionSlug()
            ));
    }

    public function extendAction(Request $request , $token){
        $em = $this->getDoctrine()->getManager();
        $job =   $em->getRepository("AlyyaJobeetBundle:Job")->findOneByToken($token);
        if(!$job){
            throw $this->createNotFoundException();
        }
        $extendForm = $this->createPublishForm($job);
        $extendForm->handleRequest($request);

        if($extendForm->isSubmitted() && $extendForm->isValid()){

            if(!$job->extend()){
                $this->addFlash('notice', 'This job is could not extended yet , you can do it 5 days before the expired day');
            }
            $em->persist($job);
            $em->flush();
            $this->addFlash('notice', sprintf('This job is now published for until %s',$job->getExpiresAt()->format('Y-m-d')));

        }
        return $this->redirectToRoute('alyya_job_preview',
            array(
                'token' => $job->getToken() ,
                'company' => $job->getCompanySlug(),
                'location' => $job->getLocationSlug(),
                'position' => $job->getPositionSlug()
            ));
    }

    /**
     * Displays a form to edit an existing Job entity.
     *
     */
    public function editAction(Request $request, Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('Alyya\JobeetBundle\Form\JobType', $job);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('alyya_job_preview', array('token' => $job->getToken()));
        }

        return $this->render('job/edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, Job $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('alyya_job_index');
    }

    /**
     * Creates a form to delete a Job entity.
     *
     * @param Job $job The Job entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alyya_job_delete', array('token' => $job->getToken())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function createPublishForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alyya_job_publish', array('token' => $job->getToken())))
            ->setMethod('POST')
            ->getForm()
        ;
    }

    private function createExtendForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alyya_job_extend', array('token' => $job->getToken())))
            ->setMethod('POST')
            ->getForm()
        ;
    }
}

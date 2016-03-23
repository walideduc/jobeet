<?php

namespace Alyya\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
//    public function showAction($slug)
//    {
//        dump($slug);
//        $em = $this->getDoctrine()->getEntityManager();
//        $category = $em->getRepository('AlyyaJobeetBundle:Category')->findOneBySlug($slug);
//        if(!$category){
//            throw $this->createNotFoundException('Unable to find Category entity');
//        }
//        $category->setActiveJobs($em->getRepository('AlyyaJobeetBundle:Job')->getActiveJobs($category->getId(),$this->container->getParameter('category_job_per_page')));
//        return $this->render('category/show.html.twig', array(
//            'category' => $category
//        ));
//    }
    public function showAction(Request $request,$slug,$page)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $category = $em->getRepository('AlyyaJobeetBundle:Category')->findOneBySlug($slug);
        if(!$category){
            throw $this->createNotFoundException('Unable to find Category entity');
        }

        $query = $em->getRepository('AlyyaJobeetBundle:Job')->getActiveJobsQuery($category->getId());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $this->container->getParameter('category_job_per_page')
        );
        $category->setActiveJobs($pagination);
        return $this->render('category/show.html.twig', array(
            'category' => $category
        ));
    }

}

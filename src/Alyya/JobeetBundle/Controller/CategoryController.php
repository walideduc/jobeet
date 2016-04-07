<?php

namespace Alyya\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function showAction($slug,$page)
    {
        $em = $this->getDoctrine()->getManager();
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

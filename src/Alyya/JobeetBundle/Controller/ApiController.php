<?php

namespace Alyya\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ApiController extends Controller
{
    public function listAction(Request $request , $token, $_format)
    {
        $em =$this->getDoctrine()->getManager();
        $affiliate = $em->getRepository('AlyyaJobeetBundle:Affiliate')->getForToken($token);
        //dump($affiliate);
        if (!$affiliate){
            throw $this->createNotFoundException('This Affiliate does not exist or not activated');
        }

        $activeJobs =  $em->getRepository('AlyyaJobeetBundle:Job')->getActiveJobs(null , null , $affiliate->getId());

        foreach ($activeJobs as $job){
            $jobs[$this->get('router')->generate('alyya_job_show' ,
                array('company' => $job->getCompanySlug(),
                    'location' => $job->getLocationSlug(),
                    'id' => $job->getId(),
                    'position' => $job->getPositionSlug()), UrlGeneratorInterface::ABSOLUTE_URL)] = $job->asArray($request->getHost());
        }

        $format = $request->getRequestFormat();
        $jsonData = json_encode($jobs);

        if ($format == 'json'){
            $response = new Response();
            $response->setContent($jsonData);
            $response->headers->set('Content-Type','application/json');
            return $response ;
        }
        return $this->render('api/jobs.'.$format.'.twig', array(
            'jobs' => $jobs
        ));
    }

}

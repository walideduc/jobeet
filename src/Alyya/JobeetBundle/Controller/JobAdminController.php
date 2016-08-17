<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 15/08/16
 * Time: 17:42
 */

namespace Alyya\JobeetBundle\Controller;


use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;


class JobAdminController extends Controller
{
    public function batchActionExtend(ProxyQueryInterface $selectedModelQuery){
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->admin->getModelManager();

        $selectedModels = $selectedModelQuery->execute();

        try {
            foreach ($selectedModels as $selectedModel) {
                $selectedModel->extend();
                $modelManager->update($selectedModel);
            }
        } catch (Exception $e) {
            $this->get('session')->getFlashBag()->add('sonata_flash_error', $e->getMessage());

            return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
        }

        $this->get('session')->getFlashBag()->add('sonata_flash_success',  sprintf('The selected jobs validity has been extended until %s.', date('m/d/Y', time() + 86400 * 30)));

        return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
    }


    public function batchActiondeleteNeverActivatedIsRelevant(){
        return true;
    }

    public function batchActiondeleteNeverActivated(){
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $nb = $em->getRepository('AlyyaJobeetBundle:Job')->cleanup(1);

        if ($nb) {
            $this->get('session')->getFlashBag()->add('sonata_flash_success',  sprintf('%d never activated jobs have been deleted successfully.', $nb));
        } else {
            $this->get('session')->getFlashBag()->add('sonata_flash_info',  'No job to delete.');
        }

        return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));

    }

}
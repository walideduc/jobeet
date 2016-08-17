<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 14/08/16
 * Time: 12:57
 */

namespace Alyya\JobeetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Alyya\JobeetBundle\Entity\Job;

class JobAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('type','choice' , array(
        'choices'  =>  Job::getTypes()))
        ->add('category','sonata_type_model', array(
            'class' => 'Alyya\JobeetBundle\Entity\Category',
            'property' => 'name'))
        ->add('company')
        ->add('logo', null , ['label' => 'Company logo'])
        ->add('file', FileType::class , ['label' => 'File' , 'required' => false])
        ->add('url')
        ->add('position')
        ->add('location')
        ->add('description')
        ->add('how_to_apply', null , ['label' => 'How to apply ?'])
        ->add('is_public', null , ['label' => 'Public ?'])
        ->add('is_activated')
        ->add('email');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('company')
            ->add('position')
            ->add('description')
            ->add('is_activated')
            ->add('is_public')
            ->add('email')
            ->add('expires_at');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('company')
        ->add('position')
        ->add('location')
        ->add('url')
        ->add('is_activated')
        ->add('email')
        ->add('category')
        ->add('expires_at')
        ->add('_action', 'actions', array(
            'actions' => array(
                'view' => array('name' => 'show'),
                'edit' => array(),
                'delete' => array(),
            )
        ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('category')
            ->add('type')
            ->add('company')
            ->add('webPath', 'string', array('template' => 'jobAdmin:list_image.html.twig'))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('is_public')
            ->add('is_activated')
            ->add('token')
            ->add('email')
            ->add('expires_at');
    }

    public function getBatchActions(){
        // retrieve the default batch actions (currently only delete)
        $actions = parent::getBatchActions();

        if ($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE'))
        {
            $actions['extend'] = array(
                'label' => 'Extend',
                'ask_confirmation' => true
            );

            $actions['deleteNeverActivated'] = array(
                'label'            => 'Delete never activated jobs',
                'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
            );

        }

        return $actions;
    }
}
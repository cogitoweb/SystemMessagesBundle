<?php

namespace Cogitoweb\SystemMessagesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Description of SystemMessageAdmin
 *
 * @author Daniele Artico <daniele.artico@cogitoweb.it>
 */

class SystemMessageAdmin extends Admin
{
	protected $datagridValues = [
		'_sort_by'    => 'createdAt',
		'_sort_order' => 'DESC'
	];
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {
		$collection
			->remove('create')
			->remove('edit')
			->remove('delete')
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('severity',  'doctrine_orm_choice', [], 'choice', ['choices' => [
				'Emergency' => 'Emergency',
				'Alert'     => 'Alert',
				'Critical'  => 'Critical',
				'Error'     => 'Error',
				'Warning'   => 'Warning',
				'Notice'    => 'Notice',
				'Info'      => 'Info',
				'Debug'     => 'Debug'
			]])
			->add('message')
			->add('createdAt', 'doctrine_orm_datetime_range', [], null, [
				'widget' => 'single_text',
				'attr'   => ['class' => 'datepicker'],
				'format' => 'dd/MM/yyyy'
			])
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('severity')
			->add('shortMessage')
			->add('createdAt', 'datetime', ['pattern'  => 'dd/MM/yyyy HH:mm:ss'])
			->add('_action', 'actions', ['actions' => [
				'show'   => [],
				'edit'   => [],
				'delete' => []
			]])
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureFormFields(FormMapper $formMapper) {}

	/**
	 * {@inheritdoc}
	 */
	protected function configureShowFields(ShowMapper $showMapper)
	{
		$showMapper
			->add('code')
			->add('severity')
			->add('message')
			->add('createdAt', 'datetime', ['pattern'  => 'dd/MM/yyyy HH:mm:ss'])
		;
	}
}
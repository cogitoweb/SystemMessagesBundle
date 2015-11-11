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
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('severity')
			->add('message')
			->add('createdAt', 'doctrine_orm_datetime_range', [], null, [
				'widget' => 'single_text',
				'attr'   => ['class' => 'datepicker'],
				'format' => 'dd/MM/yyyy HH:mm:ss'
			])
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('code')
			->add('severity')
			->add('message')
			->add('createdAt', 'datetime', ['pattern'  => 'dd/MM/yyyy HH:mm:ss'])
			->add('_action', 'actions', ['actions' => [
				'show' => []
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
<?php
namespace Cogitoweb\SystemMessagesBundle\Services;

use Doctrine\ORM\EntityManager;
use Cogitoweb\SystemMessagesBundle\Entity\SystemMessage;

/**
 * Description of SystemMessagesService
 *
 * @author Daniele Artico <daniele.artico@cogitoweb.it>
 */
class SystemMessagesService
{
	protected $em;
	
	/**
	 * Constructor
	 * 
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 * Write message into database
	 * 
	 * @param string  $message
	 * @param integer $code
	 */
	public function write($message, $code = null)
	{
		$sm = new SystemMessage();
		
		$sm
			->setMessage($message)
			->setCode($code)
		;
		
		$this->em->persist($sm);
		$this->em->flush();
	}
}
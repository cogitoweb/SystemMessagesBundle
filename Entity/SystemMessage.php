<?php
namespace Cogitoweb\SystemMessagesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of SystemMessage
 *
 * @author Daniele Artico <daniele.artico@cogitoweb.it>
 */

/**
 * @ORM\Table
 * @ORM\Entity
 */
class SystemMessage
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=3, nullable=true)
	 * @Assert\Type(type="integer")
	 * @Assert\Range(min=0, max=999)
	 */
	protected $code;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=20, nullable=true)
	 * @Assert\Choice(choices={"Emergency", "Alert", "Critical", "Error", "Warning", "Notice", "Info", "Debug"})
	 */
	protected $severity;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank()
	 */
	protected $message;
	
	/**
	 *
	 * @var DateTime
	 * 
	 * @ORM\Column(type="datetime", options={"default": "now()"}))
	 * @Assert\DateTime()
	 */
	protected $createdAt;
	
	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="read", type="boolean", options={"default": false})
	 * @Assert\NotNull()
	 */
	protected $read = false;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setCreatedAt(new \DateTime());
	}
	
	/**
	 * To string
	 */
	public function __toString() {
		if ($this->getId()) {
			return sprintf('%s (%s)', $this->getSeverity(), $this->getCreatedAt()->format('m/d/Y H:i:s'));
		};
		
		return 'n/a';
	}
	
    /**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set code
	 *
	 * @param  string $code
	 * @return SystemMessage
	 */
	public function setCode($code)
	{
		$this->code = $code;
		
		$severity = null;
		switch (substr($code, 0, 1)) {
			case 1:
				$severity = 'Debug';
				break;
			case 2:
				switch (substr($code, 1, 1)) {
					case 0:
					case 1:
					case 2:
					case 3:
					case 4:
						$severity = 'Info';
						break;
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:
						$severity = 'Notice';
						break;
					default:
						
				}
				break;
			case 3:
				$severity = 'Warning';
				break;
			case 4:
				$severity = 'Error';
				break;
			case 5:
				switch (substr($code, 1, 1)) {
					case 0:
					case 1:
					case 2:
					case 3:
					case 4:
						$severity = 'Critical';
						break;
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:
						$severity = 'Alert';
						break;
					default:
						
				}
				break;
			case 6:
				$severity = 'Emergency';
				break;
			default:
				
		}
		$this->setSeverity($severity);
		
		return $this;
	}
	
	/**
	 * Get code
	 *
	 * @return string 
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	/**
	 * Set severity
	 *
	 * @param  string $severity
	 * @return SystemMessage
	 */
	public function setSeverity($severity)
	{
		$this->severity = $severity;
		
		return $this;
	}
	
	/**
	 * Get severity
	 *
	 * @return string 
	 */
	public function getSeverity()
	{
		return $this->severity;
	}
	
	/**
	 * Set message
	 *
	 * @param  string $message
	 * @return SystemMessage
	 */
	public function setMessage($message)
	{
		$this->message = $message;

		return $this;
	}
	
	/**
	 * Get message
	 *
	 * @return string 
	 */
	public function getMessage()
	{
		return $this->message;
	}
	
	/**
	 * Get message
	 *
	 * @return string 
	 */
	public function getShortMessage()
	{
		return sprintf('%s...', substr($this->message, 0, 200));
	}
	
	/**
	 * Set createdAt
	 *
	 * @param  \DateTime $createdAt
	 * @return SystemMessage
	 */
	public function setCreatedAt(\DateTime $createdAt = null)
	{
		$this->createdAt = $createdAt;
		
		return $this;
	}
	
	/**
	 * Get createdAt
	 *
	 * @return \DateTime 
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * Set read
	 *
	 * @param  boolean $read
	 * @return SystemMessage
	 */
	public function setRead($read)
	{
		$this->read = $read;
		
		return $this;
	}
	
	/**
	 * Get read
	 *
	 * @return boolean 
	 */
	public function getRead()
	{
		return $this->read;
	}
}
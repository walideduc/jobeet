<?php

namespace Alyya\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Alyya\JobeetBundle\Utils\Jobeet;

/**
 * Job
 */
class Job
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $how_to_apply;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_public;

    /**
     * @var boolean
     */
    private $is_activated;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $expires_at;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Alyya\JobeetBundle\Entity\Category
     */
    private $category;

    public $file ;


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
     * Set type
     *
     * @param string $type
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }



/*    public function setFile(File $file){
        $this->file = $file ;
        return $this ;
    }

    public function getFile(){
        return $this->file;
    }*/

    /**
     * Set logo
     *
     * @param string $logo
     * @return Job
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set how_to_apply
     *
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;

        return $this;
    }

    /**
     * Get how_to_apply
     *
     * @return string 
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Job
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;

        return $this;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Job
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set expires_at
     *
     * @param \DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;

        return $this;
    }

    /**
     * Get expires_at
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Job
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Job
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param \Alyya\JobeetBundle\Entity\Category $category
     * @return Job
     */
    public function setCategory(\Alyya\JobeetBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Alyya\JobeetBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt()){
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    public function getCompanySlug(){
        return Jobeet::slugify($this->getCompany());
    }
    public function getPositionSlug(){
        return Jobeet::slugify($this->getPosition());
    }
    public function getLocationSlug(){
        return Jobeet::slugify($this->getPosition());
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiredAtValue()
    {
        $now = $this->getCreatedAt() ? $this->getCreatedAt()->format('U') : time();
        $this->expires_at = new \DateTime(date('Y-m-d H:i:s', $now + 86400 * 30));
    }

    static public function getTypes(){
        return array('full-time' => 'Full time', 'part-time' => 'Part time', 'freelance' => 'Freelance');
    }

    /** This function is used for supplying the Choices with a Callback Function in the validation.yml
     * @return array
     */
    static public function getTypesValue(){
        return array_keys(self::getTypes());
    }

    public function getUploadDir(){
        return 'uploads/jobs';
    }

    public function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    public function getWebPath(){
        return $this->logo === null ? null : $this->getUploadDir().'/'.$this->logo;
    }

    public function getAbsolutePath(){
        return $this->logo === null ? null : $this->getUploadRootDir().'/'.$this->logo;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if ($this->file !== null){
            $this->logo = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if ($this->file === null){
            return ;
        }
        // If there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(),$this->logo);
        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if (file_exists($file)){
            unlink($file);
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken()) {
            $this->token = sha1($this->getEmail().rand(11111, 99999));
        }
    }

    public function expiresSoon(){
        return  $this->getDaysBeforeExpires() < 5 ;
    }


    public function isExpired(){
        return $this->getDaysBeforeExpires() < 0 ;
    }

    public function getDaysBeforeExpires(){
        return ceil(( $this->getExpiresAt()->format('U') - time() ) / 86400 );
    }

    public function publish(){
        $this->setIsActivated(1);
    }

    public function extend(){
        if($this->expiresSoon()){
           $this->setExpiresAt(new \DateTime(date('Y-m-d H:i:s',time() + 86400 * 30)));
            return true;
        }
        return false;
    }

    public function asArray($host)
    {
        return array(
            'category'     => $this->getCategory()->getName(),
            'type'         => $this->getType(),
            'company'      => $this->getCompany(),
            'logo'         => $this->getLogo() ? 'http://' . $host . '/uploads/jobs/' . $this->getLogo() : null,
            'url'          => $this->getUrl(),
            'position'     => $this->getPosition(),
            'location'     => $this->getLocation(),
            'description'  => $this->getDescription(),
            'how_to_apply' => $this->getHowToApply(),
            'expires_at'   => $this->getCreatedAt()->format('Y-m-d H:i:s'),
        );
    }
}

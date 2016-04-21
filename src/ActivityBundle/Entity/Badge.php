<?php

namespace ActivityBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UserBundle\Entity\User;

class Badge
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $level;

    /**
     * @var integer
     */
    private $minXp;

    /**
     * @var integer
     */
    private $maxXp;

    /**
     * @var UploadedFile
     */
    private $logo;

    /**
     * @var string
     */
    private $logoUrl;

    /**
     * @var string
     */
    private $oldLogoUrl;

    /**
     * @var ArrayCollection
     */
    private $users;

    /**
     * Badge constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Badge
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Badge
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinXp()
    {
        return $this->minXp;
    }

    /**
     * @param int $minXp
     * @return Badge
     */
    public function setMinXp($minXp)
    {
        $this->minXp = $minXp;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxXp()
    {
        return $this->maxXp;
    }

    /**
     * @param int $maxXp
     * @return Badge
     */
    public function setMaxXp($maxXp)
    {
        $this->maxXp = $maxXp;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param UploadedFile $logo
     * @return Badge
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @param string $logoUrl
     * @return Badge
     */
    public function setLogoUrl($logoUrl)
    {
        $this->oldLogoUrl = $this->logoUrl;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getOldLogoUrl()
    {
        return $this->oldLogoUrl;
    }

    /**
     * @param string $oldLogoUrl
     * @return Badge
     */
    public function setOldLogoUrl($oldLogoUrl)
    {
        $this->oldLogoUrl = $oldLogoUrl;
        return $this;
    }

    /**
     * @param User $user
     * @param bool $updateRelation
     * @return $this
     */
    public function addUser(User $user, $updateRelation = true)
    {
        $this->users[] = $user;
        if ($updateRelation) {
            $user->addBadge($this, false);
        }

        return $this;
    }

    /**
     * @param User $user
     * @param bool $updateRelation
     *
     * @return $this;
     */
    public function removeUser(User $user, $updateRelation = true)
    {
        $this->users->removeElement($user);
        if($updateRelation){
            $user->removeBadge($this, false);
        }

        return $this;
    }

    /**
     * @param ArrayCollection $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if(!is_null($this->title)){
            return $this->title;
        }

        return '';
    }

}
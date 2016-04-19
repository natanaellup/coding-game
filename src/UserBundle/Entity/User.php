<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class User extends BaseUser
{

    /**
     * Default photo url.
     */
    const DEFAULT_PHOTO_URL = 'uploads/user_avatar/avatar-default.png';

    /**
     * User id.
     *
     * @var integer
     */
    protected $id;

    /**
     * User birthday.
     *
     * @var \DateTime
     */
    protected $birthday;

    /**
     * Avatar url.
     *
     * @var string
     */
    protected $avatarUrl;

    /**
     * Old avatar path.
     *
     * @var string
     */
    protected $oldAvatarUrl;

    /**
     * @var UploadedFile
     */
    protected $avatar;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get user birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set user birthday.
     *
     * @param \DateTime $birthday
     * @return $this
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get avatar url.
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if(!is_null($this->avatarUrl)){
            return $this->avatarUrl;
        }

        return self::DEFAULT_PHOTO_URL;
    }

    /**
     * Set avatarUrl.
     *
     * @param $avatarUrl
     * @return $this
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->oldAvatarUrl = $this->avatarUrl;
        $this->avatarUrl = $avatarUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOldAvatarUrl()
    {
        return $this->oldAvatarUrl;
    }

    /**
     * @param string $oldAvatarUrl
     * @return User
     */
    public function setOldAvatarUrl($oldAvatarUrl)
    {
        $this->oldAvatarUrl = $oldAvatarUrl;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param UploadedFile $avatar
     * @return User
     */
    public function setAvatar($avatar = null)
    {
        $this->avatar = $avatar;
        return $this;
    }


}


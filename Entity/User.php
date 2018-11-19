<?php

namespace NCMF\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;


class User extends BaseUser
{
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @var \NCMF\UserBundle\Entity\UserInfo
     */
    private $userInfo;


    /**
     * Set userInfo
     *
     * @param \NCMF\UserBundle\Entity\UserInfo $userInfo
     *
     * @return User
     */
    public function setUserInfo(\NCMF\UserBundle\Entity\UserInfo $userInfo = null)
    {
        $this->userInfo = $userInfo;

        return $this;
    }

    /**
     * Get userInfo
     *
     * @return \NCMF\UserBundle\Entity\UserInfo
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }
}

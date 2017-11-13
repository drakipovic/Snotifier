<?php
/**
 * Created by PhpStorm.
 * User: dinorakipovic
 * Date: 08/11/2017
 * Time: 14:12
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Alert
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="alerts")
 */
class Alert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="integer")
     */
    protected $userId;

    /**
     * @var
     * @ORM\Column(type="text")
     */
    protected $url;

    /**
     * @var
     * @ORM\Column(type="datetime")
     *
     */
    protected $datetime;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime()
    {
        $this->datetime = new \DateTime("now");
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

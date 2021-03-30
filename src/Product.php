<?php

/**
 * Class Product
 * @Entity @Table(name="products")
 */
class Product
{
    /** @id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="string") */
    protected $name;
    /** @Column(type="text") */
    protected $image;
    /** @Column(type="datetime") */
    protected $creation_date;
    /** @Column(type="string") */
    protected $user_name;
    /** @Column (type="integer") */
    protected $avg_price;

    public function __construct()
    {
        $this->creation_date = new DateTime();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    public function setAvgPrice($avg_price)
    {
        $this->avg_price = $avg_price;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getCreationDate()
    {
        return date_format($this->creation_date, 'Y-m-d H:i:s');
    }
}
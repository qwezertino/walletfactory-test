<?php

/**
 * Class Review
 * @Entity @Table(name="reviews")
 */
class Review
{
    /**
     * @id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @Column(type="string")
     */
    protected $user_name;
    /**
     * @Column(type="integer")
     */
    protected $rate;
    /**
     * @Column(type="string")
     */
    protected $message;
    /**
     * @Column(type="datetime")
     */
    protected $creation_date;
    /**
     * @Column(type="integer")
     */
    protected $product_id;

    public function __construct()
    {
        $this->creation_date = new DateTime();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUserName()
    {
        return $this->user_name;
    }
    public function getRate()
    {
        return $this->rate;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function getCreationDate()
    {
        return date_format($this->creation_date, 'Y-m-d H:i:s');
    }

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }
}
<?php


namespace Controllers;


use App\Controller;
use App\Database;
use Cake\Validation\Validator;
use Selective\Validation\Converter\CakeValidationConverter;
use Selective\Validation\Exception\ValidationException;

class Review extends Controller
{

    public $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function new_review()
    {
        return $this->render('AddReview');
    }
    public function add($params)
    {
        $this->validator
            ->requirePresence('message', 'This field is required')
            ->notEmptyString('message', 'Message is required')
            ->maxLength('message', 120, 'Too long')
            ->requirePresence('user_name', 'This field is required')
            ->notEmptyString('user_name', 'Username is required')
            ->minLength('user_name', 2, 'Too short')
            ->maxLength('user_name', 30, 'Too long')
            ->requirePresence('rate', 'This field is required')
            ->notEmptyString('rate', 'Rate must be not empty!')
            ->maxLength('rate', 2, 'Too long');

        $validationResult = CakeValidationConverter::createValidationResult($this->validator->validate($params));

        if ($validationResult->fails()) {
            throw new ValidationException('Validation failed. Please check your input.', $validationResult);
        }

        $review = new \Review();
        $review->setUserName($params['user_name']);
        $review->setMessage($params['message']);
        $review->setRate($params['rate']);
        $review->setProductId($params['product_id']);

        $db = (new Database())->db;

        $db->persist($review);
        $db->flush();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
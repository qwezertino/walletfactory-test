<?php


namespace Controllers;

use App\Controller;
use App\Database;
use app\exceptions\InvalidRouteException;
use Cake\Validation\Validator;
use Selective\Validation\Converter\CakeValidationConverter;
use Selective\Validation\Exception\ValidationException;

class Product extends Controller
{
    public $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function new_product()
    {
        return $this->render('AddProduct');
    }
    /**
     * @param $params
     * @throws \Doctrine\ORM\ORMException
     */
    public function add($params)
    {
        $this->validator
            ->requirePresence('name', 'This field is required')
            ->notEmptyString('name', 'Product name is required')
            ->minLength('name', 3, 'Too short')
            ->maxLength('name', 60, 'Too long')
            ->requirePresence('user_name', 'This field is required')
            ->notEmptyString('user_name', 'Username is required')
            ->minLength('user_name', 2, 'Too short')
            ->maxLength('user_name', 60, 'Too long')
            ->requirePresence('avg_price', 'This field is required')
            ->notEmptyString('avg_price', 'User is required')
            ->maxLength('avg_price', 8, 'Too long');

        $validationResult = CakeValidationConverter::createValidationResult($this->validator->validate($params));

        if ($validationResult->fails()) {
            throw new ValidationException('Validation failed. Please check your input.', $validationResult);
        }

        $image_base64 = base64_encode(file_get_contents(
            empty($params['image_url']) ? $_FILES['image']['tmp_name'] : $params['image_url'])
        );
        $image = 'data:image/png;base64,'.$image_base64;

        $product = new \Product();
        $product->setName($params['name']);
        $product->setUserName($params['user_name']);
        $product->setAvgPrice($params['avg_price']);
        $product->setImage($image);

        $db = (new Database())->db;

        $db->persist($product);
        $db->flush();

        header('Location: /');
    }

    /**
     * @param $id
     * @return false|string
     * @throws InvalidRouteException
     */
    public function info($id)
    {
        $field = ['id' =>(int)$id];

        $this->validator
            ->requirePresence('id', 'This field is required')
            ->integer('id', 'ID must be a integer!');

        $validationResult = CakeValidationConverter::createValidationResult($this->validator->validate($field));

        if ($validationResult->fails()) {
            throw new ValidationException('Validation failed. Please check your input.', $validationResult);
        }

        $db = (new Database())->db;
        $product = $db->find(\Product::class, $field['id']);

        if(is_null($product)) {
            throw new InvalidRouteException();
        }

        $reviewRepository = $db->getRepository(\Review::class);

        $reviews = $reviewRepository->findBy(['product_id' => $field['id']]);

        $reviewAvg = round($reviewRepository->createQueryBuilder('r')
            ->select('avg(r.rate)')
            ->where('r.product_id = :product_id')
            ->setParameter('product_id', $field['id'])
            ->getQuery()
            ->getSingleScalarResult());

        return $this->render('ProductInfo', ['product' => $product, 'reviews' => $reviews, 'review_avg' => $reviewAvg]);

    }
    public function remove()
    {

    }
}
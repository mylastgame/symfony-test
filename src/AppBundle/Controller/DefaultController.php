<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Tests\RememberMe\PersistentTokenBasedRememberMeServicesTest;
use AppBundle\Entity\Category;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/create", name="create_product")
     * @return Response
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        //no query yet
        $em->persist($product);

        //actual query
        $em->flush();

        return new Response('Saved new product with id ' . $product->getId());
    }

    /**
     * @Route("/show/{productId}", name="show_product",  requirements={"page": "\d+"})
     *
     * @param $productId
     * @return Response
     */
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneByIdJoinedToCategory($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        return $this->render('default/show_product.html.twig', array(
            'product' => $product,
            'category' => $product->getCategory()
        ));

    }


    /**
     * @Route("/update/{productId}", name="update_product")
     *
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/getby/{property}/{value}", name="getby_product")
     * @param $property
     * @param $value
     */
    public function getByAction($property, $value)
    {
        $query = $this->getDoctrine()->getManager()
            ->createQuery(
                "SELECT p
                FROM AppBundle:Product p
                WHERE p.{$property} > :price
                ORDER BY p.id ASC"
            )->setParameter($property, $value);

        $products = $query->getResult();
        return new Response(dump($products));
    }

    /**
     * @Route("/create-product", name="create_product")
     * @return Response
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

}

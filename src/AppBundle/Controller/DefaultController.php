<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/products", name="products")    
     */
    public function productsAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$products=$em->getRepository("AppBundle:Product")->findAll();
    	if($products){
    		return $this->render('default/products.html.twig', array("products" => $products));
    	}
        return $this->render('default/products.html.twig', array("products" => ""));
    }

    /**
     * @Route("/new_product", name="new_product")    
    */
    public function new_productAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	$ban="";
    	if($request->getMethod()=="POST"){ 
            $code_product=$request->get("codeproduct"); 
            $name_product=$request->get("nameproduct");
            $description=$request->get("description");
            $brand=$request->get("brand");
            $categoryid=$request->get("category");
            $category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($categoryid);
            $price=$request->get("price");

            //Codigo y nombre no se pueden repetir
            $code=$em->getRepository("AppBundle:Product")->findOneBycodeproduct($code_product);
            $name=$em->getRepository("AppBundle:Product")->findOneBynameproduct($name_product);
            if($code){
            	$ban="El codigo del producto ya existe, registro no guardado";	
            }
            elseif($name){
            	$ban="El nombre del producto ya existe, registro no guardado";
            }
            else{
	            if($category){
	            	$product = new \AppBundle\Entity\Product(); 
		            $product->setCodeproduct($code_product);
		            $product->setNameproduct($name_product);
		            $product->setDescription($description);
		            $product->setBrand($brand);            
		            $product->setCategory($category); 
		            $product->setPrice($price);
		            $em->persist($product); 
		            $em->flush();
	            	$ban="El producto se guardo correctamente";	
	            }
	        }         
        }
        return $this->render('default/new_product.html.twig', array("ban" => $ban, "categories" => $categories));

    }
	
	/**
     * @Route("/edit_product/{idproduct}", name="edit_product")   
    */
    public function edit_productAction(Request $request,$idproduct)
    {
    	$em=$this->getDoctrine()->getManager();
    	$ban="";
    	$product=$em->getRepository("AppBundle:Product")->findOneByid($idproduct);
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	if($product){
    		$ban="Recuerde que todos los campos son obligatorios";
			return $this->render('default/edit_product.html.twig', array("ban"=>$ban, "product"=>$product, "categories"=>$categories));
    	}
    	return $this->render('default/edit_product.html.twig', array("ban"=>"", "product"=>"", "categories"=> ""));
    }

    /**
     * @Route("/update_product", name="update_product")    
    */
    public function update_productAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$ban="";
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	if($request->getMethod()=="POST"){ 
            $id_product=$request->get("idproduct");
            $product=$em->getRepository("AppBundle:Product")->findOneByid($id_product);
            $code_product=$request->get("codeproduct"); 
            $name_product=$request->get("nameproduct");
            $description=$request->get("description");
            $brand=$request->get("brand");
            $categoryid=$request->get("category");
            $category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($categoryid);
            $price=$request->get("price");

           	//Codigo y nombre no se pueden repetir
            $code=$em->getRepository("AppBundle:Product")->findOneBycodeproduct($code_product);
            $name=$em->getRepository("AppBundle:Product")->findOneBynameproduct($name_product);
            if($product){
	            if($code && $product->getCodeproduct()!=$code_product){
	            	$ban="El codigo del producto ya existe, registro no guardado";	
	            }elseif($name && $product->getNameproduct()!=$name_product){
	            	$ban="El nombre del producto ya existe, registro no guardado";
	            }else{	
		            $product->setCodeproduct($code_product);
		            $product->setNameproduct($name_product);
		            $product->setDescription($description);
		            $product->setBrand($brand);            
		            $product->setCategory($category); 
		            $product->setPrice($price);
		            $em->persist($product); 
		            $em->flush();
		            $ban="El producto se guardó correctamente";
	        	}
	        }else{
	        	$ban="No exite un producto con el id: ".$id_product;
	        }
        }
        return $this->render('default/edit_product.html.twig',array("ban" => $ban, "product" => $product, "categories"=>$categories));
    }
    
    /**
     * @Route("/delete_product", name="delete_product")    
     */
    public function delete_productAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	if($request->getMethod()=="POST"){ 
    		$id_product=$request->get("idproduct"); 
    		$product=$em->getRepository("AppBundle:Product")->findOneByid($id_product);
    		if($product){
    			$em->remove($product); 
		        $em->flush();
    		}
    	}
    	$products=$em->getRepository("AppBundle:Product")->findAll();
    	return $this->render('default/products.html.twig',array("products" => $products));
    }

    /**
     * @Route("/categories", name="categories")    
     */
    public function categoriesAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	if($categories){
    		return $this->render('default/categories.html.twig', array("categories" => $categories));
    	}
        return $this->render('default/categories.html.twig', array("categories" => ""));
    }


    /**
     * @Route("/new_category", name="new_category")  
    */ 
    public function new_categoryAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$ban="";
    	if($request->getMethod()=="POST"){ 
            $code_category=$request->get("codecategory"); 
            $name_category=$request->get("namecategory");
            $description=$request->get("description");
            $active=$request->get("active");
            if($active){
            	$active=1;
            }
            else{
            	$active=0;	
            }
            //Codigo y nombre no se pueden repetir
            $code=$em->getRepository("AppBundle:CategoryProduct")->findOneBycodecategory($code_category);
            $name=$em->getRepository("AppBundle:CategoryProduct")->findOneBynamecategory($name_category);
            if($code){
            	$ban="El codigo de la categoria ya existe, registro no guardado";	
            }
            elseif($name){
            	$ban="El nombre de la categoria ya existe, registro no guardado";
            }
            else{
            	$category = new \AppBundle\Entity\CategoryProduct(); 
	            $category->setCodecategory($code_category);
	            $category->setNamecategory($name_category);
	            $category->setDescription($description);      
	            $category->setActive($active);
	            $em->persist($category); 
	            $em->flush();
	            $ban="La categoria se guardó correctamente";
	        }
        }
        return $this->render('default/new_category.html.twig',array("ban" => $ban));
    }

	/**
     * @Route("/edit_category/{idcategory}", name="edit_category")    
    */ 
    public function edit_categoryAction(Request $request,$idcategory)
    {
    	$em=$this->getDoctrine()->getManager();
    	$ban="";
    	$category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($idcategory);
    	if($category){
    		$ban="Recuerde que todos los campos son obligatorios";
			return $this->render('default/edit_category.html.twig',array("ban" => $ban, "category"=>$category));
    	}
    	return $this->render('default/edit_category.html.twig',array("ban" => "", "category"=> ""));
    }

    /**
     * @Route("/update_category", name="update_category")   
    */ 
    public function update_categoryAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	$ban="";
    	if($request->getMethod()=="POST"){ 
    		$id_category=$request->get("idcategory");
    		$category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($id_category);
            $code_category=$request->get("codecategory"); 
            $name_category=$request->get("namecategory");
            $description=$request->get("description");
            $active=$request->get("active");
            if($active){
            	$active=1;
            }
            else{
            	$active=0;	
            }
            //Codigo y nombre no se pueden repetir
            $code=$em->getRepository("AppBundle:CategoryProduct")->findOneBycodecategory($code_category);
            $name=$em->getRepository("AppBundle:CategoryProduct")->findOneBynamecategory($name_category);
            if($category){
	            if($code && $category->getCodecategory()!=$code_category){
	            	$ban="El codigo de la categoria ya existe, registro no guardado";	
	            }elseif($name && $category->getNamecategory()!=$name_category){
	            	$ban="El nombre de la categoria ya existe, registro no guardado";
	            }else{ 
		            $category->setCodecategory($code_category);
		            $category->setNamecategory($name_category);
		            $category->setDescription($description);      
		            $category->setActive($active);
		            $em->persist($category); 
		            $em->flush();
		            $ban="La categoria se guardó correctamente";
		        }
		    }else{
	        	$ban="No exite una categoria con el id: ".$id_category;
	        }
        }
        return $this->render('default/new_category.html.twig',array("ban" => $ban, "category" => $category));
    }

    /**
     * @Route("/active_category", name="active_category")    
     */
    public function active_categoryAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	if($request->getMethod()=="POST"){ 
    		$id_category=$request->get("idcategory"); 
    		$category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($id_category);
    		if($category){
    			if($category->getActive()==0){
    				$category->setActive(1);
		        	$em->persist($category); 
	            	$em->flush();	
    			}    			
    		}
    	}
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	return $this->render('default/categories.html.twig',array("categories" => $categories));
    }

    /**
     * @Route("/deactivate_category", name="deactivate_category")    
     */
    public function deactivate_categoryAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
    	if($request->getMethod()=="POST"){ 
    		$id_category=$request->get("idcategory"); 
    		$category=$em->getRepository("AppBundle:CategoryProduct")->findOneByid($id_category);
    		if($category){
    			if($category->getActive()==1){
    				$category->setActive(0);
		        	$em->persist($category); 
	            	$em->flush();	
    			}    			
    		}
    	}
    	$categories=$em->getRepository("AppBundle:CategoryProduct")->findAll();
    	return $this->render('default/categories.html.twig',array("categories" => $categories));
    }
}

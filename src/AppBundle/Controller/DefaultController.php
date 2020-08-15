<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use Httpful\Exception\ConnectionErrorException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Exception\Exception;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

	/**
	 * @Route("/test_api", name="test_api")
	 */
    public function testApiAction(Request $request)
    {
	    // Make a request to the GitHub API with a custom
		// header of "X-Trvial-Header: Just as a demo".

	    // dump(scandir('../'));

	    try {

		    $url      = "https://sandbox.procore.com/vapid/files?project_id=1829";
		    $response = \Httpful\Request::get($url)
			    ->addHeaders(
			    	[
			    		'content-type' => 'multipart/form-data',
					    'authorization' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzUxMiJ9.eyJhaWQiOiJlNTAxNmZhYjY4MzhhYmJiMjhhZTE5NzA4NTI4NmIzYmUzZmVlZTNhYTIxMjNjODU4YzM5YTc5ZTg5M2I2OTJhIiwiZXhwIjoxNTE4ODE0MzA2LCJ1aWQiOjY4NDh9.AC1fVyM9k3chnawaV_yyEHSMyMZo7_ZONP7-SXekN9BBGPnoleG2ppjm6uur-X7XIcoh6e8qau66PUTTqNSszZt_AY3bsAtcRRz5SGMTcr61Mkv4FpM5rLc8-TPW2nG6LTvjTpuRDFbw2I8LX6VWz_ainqR3JYWELYhNkAxtH564SzoP',
				    ]
			    )
			    ->body(['file[name]' => 'robots_1.txt', 'file[parent_id]' => '35503'])
			    ->attach(['file[data]' => realpath('../web/robots.txt')])
			    ->send()
		    ;

		    dump($response); dump($response->hasErrors());
	    }
	    catch (ConnectionErrorException $e) {
		    dump($e->getMessage());
	    }
	    catch (Exception $e) {
	    	dump($e->getMessage());
	    }

	    /*echo "{$response->body->name} joined GitHub on " .
		    date('M jS', strtotime($response->body->created_at)) ."\n";*/

	    die;
    }

	/**
	 * @Route("/test_api/guzzle", name="test_api_guzzle")
	 */
    public function testApiGuzzleAction(Request $request)
    {

    	try{
		    $client = new Client();
		    $response = $client->request('POST', 'https://sandbox.procore.com/vapid/files?project_id=1829', [
			    'headers'   => [
			    	'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzUxMiJ9.eyJhaWQiOiJlNTAxNmZhYjY4MzhhYmJiMjhhZTE5NzA4NTI4NmIzYmUzZmVlZTNhYTIxMjNjODU4YzM5YTc5ZTg5M2I2OTJhIiwiZXhwIjoxNTE4ODE0MzM0LCJ1aWQiOjY4NDh9.AVafaznBEErCQzde8WGoR3d4RhPiTAXsE0WKiadQRNYESA2QlQrerZNDyq5DD-BfvwZnmpQ9qevqe2ajnarFfFnxAZFkQXOyp9uetl5e6xbo8xO0GjtOgSw_msrqTbM3RuFSNMtEbMHjSGUB2SyKjWrJiHhZ4fgYSGok7ukaoBaJ_FIS'
			    ],
			    'multipart' => [
				    [
					    'name'     => 'file[parent_id]',
					    'contents' => '35503'
				    ],
				    //[
					 //   'name'     => 'file[data]',
					 //   'contents' => fopen(realpath('../web/robots.txt'), 'r')
				    //],
				    [
					    'name'     => 'file[data]',
					    'contents' => fopen('../web/robots.txt', 'r'),
					    'filename' => 'sample_filename_2.txt',
					    'headers'  => [
						    'content-type' => 'multipart/form-data'
					    ]
				    ],
			    ]
		    ]);
		    dump($response);
	    }
	    catch (Exception $e) {
    		dump($e);
	    }

	    die;
    }
}

# insurance-php
Integration of WS PHP

<h3>About the Project</h3><br/>
For easy integration to Insurance WS of Cebuana Lhuillier Insurance Broker
<h2>Getting Started</h2>
To get the local copy of the PHP library , you need to do below steps.
<h3>Prerequisistes</h3>
<ul>
  <li>PHP</li>
  <li>laravel/laravel</li>
  <li>firebase/php-jwt</li>
  <li>mll-lab/laravel-graphql-playground (optional) for testing purposes only</li>
  <li>nuwave/lighthouse (optional) for testing purposes only </li>
</ul>
<h3>Installation</h3>
1. Clone the repo ( git clone https://github.com/jhay06/insurance-php)<br/>
2. Go to the cloned folder ( cd insurance-php)<br/>
3. Copy the app folder to your laravel root project folder (cp app /path/to/laravel-project)<br/>
4. Copy the config folder to your laravel root project folder (cp config /path/to/laravel-project)<br/>
5. Copy the storage folder to your laravel root project folder (cp storage /path/to/laravel-project)<br/>
6. Go to your laravel-project (cd /path/to/laravel-project)<br/>
7. Install php-jwt via composer (composer require firebase/php-jwt)<br/>
8. Run config clear (php artisan config:clear)<br/>
9. Run autoload (composer dump-autoload)<br/>
<h3>Checking</h3>
* <i>Note: Insurance PHP is already connected to CLIB Insurance API , GraphQL is not require and the Steps below are for testing purposes only</i><br/>
1. Install lighthouse (composer require nuwave/lighthouse)<br/>
2. Publish the lighthouse schema (php artisan vendor:publish --tag=lighthouse-schema)<br/>
3. Install the laravel-graphql-playground (composer require mll-lab/laravel-graphql-playground) <br/>
5. Go to insurance-php cloned folder (cd insurance-php)<br/>
6. copy the graphql folder to the root folder of your laravel project (cp graphql /path/to/laravel-project)<br/>
7. Go back to your laravel project <br/>
8. You may need to autoload again (composer dump-autoload)<br/>
9. run the server (php artisan serve)<br/>
10. Go to http://localhost:8000/graphql-playground ( varies depends on php artisan serve)<br/>
11. All method names of the Queries and Mutations from the schema are the actual function to call in php code under InsuranceWS class 
<h3>How to use</h3>
<pre>
<? php
<br/>
  use App\InsuranceAPI\InsuranceWS;
  use App\InsuranceAPI\Models\Request\TestNetwork;
  $ws=new InsuranceWS();
  $req=new TestNetwork();
  $req->test='hello world';
  $res=$ws->test_network($req);
  //get the result
  
  
  $result=$res->Result;
  //for the testnetwork result there's not base response if it succeed you will the message="Ok"
  
  //for the actual request there's alwas a baseresponse
  //get the baseresponse
  if($result->type=="success")
    $data=$result->data;
  }
?>
</pre>

<?php

use App\Models\Customer;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testFetchFineArtPrintByVendorID()
    {
        $response = $this->call('GET', 'apiv1/fetchFineArtPrintByVendorID/99');
        $this->assertEquals(200, $response->status());
    }

    public function testFetchFineArtPrintByVendorIDWithParam()
    {
        $response = $this->call('GET', 'apiv1/fetchFineArtPrintByVendorID/1');
        $this->assertEquals(200, $response->status());
    }

}

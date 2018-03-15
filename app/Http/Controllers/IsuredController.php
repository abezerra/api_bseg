<?php

namespace App\Http\Controllers;

use App\Services\InsuredServices;
use Illuminate\Http\Request;

/**
 * Class IsuredController
 * semi graph - centrate all informations of insured
 * @package App\Http\Controllers
 */

class IsuredController extends Controller
{


    /**
     * @var InsuredServices
     */
    private $services;

    public function __construct(InsuredServices $services)
    {
        $this->services = $services;
    }

    public function my_insurances($id)
    {
        return $this->services->my_insurances($id);
    }

    public function my_invoices()
    {
        
    }

    public function my_conversations()
    {

    }

    public function my_alerts()
    {

    }

    public function my_messages()
    {

    }

}

<?php

namespace App\Http\Controllers;

use App\Services\FriendlyInvite;
use App\Services\MailerService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FiendCreateRequest;
use App\Http\Requests\FiendUpdateRequest;
use App\Repositories\FiendRepository;
use App\Validators\FiendValidator;

/**
 * Class FiendsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FiendsController extends Controller
{
    /**
     * @var FriendlyInvite
     */
    private $invite;

    /**
     * FiendsController constructor.
     *
     * @param FiendRepository $repository
     * @param FiendValidator $validator
     */
    public function __construct( FriendlyInvite $invite)
    {
        $this->invite = $invite;
    }


    public function invite(Request $request)
    {
        return $this->invite->store($request->all());
    }
}

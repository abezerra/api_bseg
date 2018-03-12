<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MailerCreateRequest;
use App\Http\Requests\MailerUpdateRequest;
use App\Repositories\MailerRepository;
use App\Validators\MailerValidator;

/**
 * Class MailersController.
 *
 * @package namespace App\Http\Controllers;
 */
class MailersController extends Controller
{
    /**
     * @var MailerRepository
     */
    protected $repository;

    /**
     * @var MailerValidator
     */
    protected $validator;

    /**
     * MailersController constructor.
     *
     * @param MailerRepository $repository
     * @param MailerValidator $validator
     */
    public function __construct(MailerRepository $repository, MailerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $mailers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mailers,
            ]);
        }

        return view('mailers.index', compact('mailers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MailerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MailerCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mailer = $this->repository->create($request->all());

            $response = [
                'message' => 'Mailer created.',
                'data'    => $mailer->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mailer = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mailer,
            ]);
        }

        return view('mailers.show', compact('mailer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mailer = $this->repository->find($id);

        return view('mailers.edit', compact('mailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MailerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MailerUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mailer = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Mailer updated.',
                'data'    => $mailer->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Mailer deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Mailer deleted.');
    }
}

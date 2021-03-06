<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
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
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    public function paginated()
    {
        return $this->repository->paginate(5);
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
        $data = $request->all();
        try {
            for ($i = 0; $i < count($data['to']); ++$i) {
                $view_name = md5(date("D M j G:i:s T Y"));
                $template = fopen(resource_path('views/mails/' . $view_name . '.blade.php'), 'w') or die("No permissions!");

                $extends = "@extends('layouts.basic')";
                fwrite($template, $extends);
                $start_body = "@section('content')";
                fwrite($template, $start_body);
                $to = $data['to'][$i];
                if (isset($to['name'])) {
                    $data['content'] = str_replace("#nome#", $to['name'], $data['content']);
                }

                fwrite($template, $data['content']);
                $end_body = "@endsection";
                fwrite($template, $end_body);

                Mail::send(('mails/' . $view_name), ["subject" => $data['subject'], 'content' => $data['content']], function ($message) use ($data, $i, $to) {
                    $message->subject($data['subject']);
                    $message->from('sistemas@brasal.com.br', 'Alessandra mingau');
                    $message->to($to);
                });


            }

        } catch (ValidationException $exception) {
            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
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
     * @param  string $id
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
                'data' => $mailer->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
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

    public function send_tes()
    {
        $data = [];
        Mail::raw('Mensafgem de testes', function ($message) use ($data) {
            $message->subject('assunto da mensagem de testes');
            $message->from('sistemas@brasal.com.br', 'ytvsdghbfsdvagbhfdsubhfhjbfdsugvbfsdhfgjds');
            $message->to('guaracyaraujolima@gmail.com');
        });
    }
}

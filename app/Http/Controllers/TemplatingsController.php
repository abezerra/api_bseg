<?php

namespace App\Http\Controllers;

use App\Entities\Templating;
use function foo\func;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TemplatingCreateRequest;
use App\Http\Requests\TemplatingUpdateRequest;
use App\Repositories\TemplatingRepository;
use App\Validators\TemplatingValidator;

/**
 * Class TemplatingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TemplatingsController extends Controller
{
    /**
     * @var TemplatingRepository
     */
    protected $repository;

    /**
     * @var TemplatingValidator
     */
    protected $validator;

    /**
     * TemplatingsController constructor.
     *
     * @param TemplatingRepository $repository
     * @param TemplatingValidator $validator
     */
    public function __construct(TemplatingRepository $repository, TemplatingValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $templatings = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $templatings,
            ]);
        }

        return view('templatings.index', compact('templatings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TemplatingCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TemplatingCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $templating = $this->repository->create($request->all());

            $response = [
                'message' => 'Templating created.',
                'data' => $templating->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->with(['users'])->findByField('user_id', $id);
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
        $templating = $this->repository->find($id);

        return view('templatings.edit', compact('templating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TemplatingUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TemplatingUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $templating = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Templating updated.',
                'data' => $templating->toArray(),
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
                'message' => 'Templating deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Templating deleted.');
    }

    public function create_templates(Request $request)
    {
        $data = $request->all();

        $template = fopen(resource_path('views/' . $data['file_name'] . '.blade.php'), 'w') or die("Não deu para ler a piriquita do arquivo!");

        //define the extends email
        $extends = "@extends('layouts.app')";
        fwrite($template, $extends);

        //define section o content email (start body)
        $start_body = "@section('content')" . "<br />";
        fwrite($template, $start_body);

        //define of the eail tuktke ub vusykauzatuib
        $title = '<h1>' . $data['title'] . '</h1>' . "<br /> ";
        fwrite($template, $title);

        $wellcome_message = 'Wellcome to Test';
        $message_to_client = '<p>' . $wellcome_message . ' ' . $data['client_name'] . '</p>' . " <br />";
        fwrite($template, $message_to_client);

        //images
        $imageName = md5(time()) . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $template_image = "<img src='{{URL::asset('/images/" . $imageName . "')}}' alt='Imagem anexada'";
        fwrite($template, $template_image);


        //define end of content of email body
        $end_body = "@endsection";
        fwrite($template, $end_body);
        return view($data['file_name']);
    }

    public function image_templating(Request $request)
    {
        $data = $request->all();

        $img = Image::make(public_path('images/default.jpg'));
        $img->text($data['name'] . ' - ' . $data['phone'], 450, 850, function ($font) {
            $font->file(public_path('fonts/bar.ttf'));
            $font->size(26);
            $font->color('#8A1253');
            $font->align('center');
            $font->valign('top');
        });
        $imageName = md5('brasalimg') . '.jpg';
        $img->save(public_path('img/' . $imageName));

        $data['media_name'] = "https://api-bseg.brasal.com.br/img/{$imageName}";
        $data['user_id'] = 11;

        return [
            'path' => 'https://api-bseg.brasal.com.br/img/' . $imageName
        ];

    }
}

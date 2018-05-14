<?php

namespace App\Http\Controllers;

use App\Entities\MailerTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MailerTemplateCreateRequest;
use App\Http\Requests\MailerTemplateUpdateRequest;
use App\Repositories\MailerTemplateRepository;
use App\Validators\MailerTemplateValidator;

/**
 * Class MailerTemplatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MailerTemplatesController extends Controller
{
    /**
     * @var MailerTemplateRepository
     */
    protected $repository;

    /**
     * @var MailerTemplateValidator
     */
    protected $validator;

    /**
     * MailerTemplatesController constructor.
     *
     * @param MailerTemplateRepository $repository
     * @param MailerTemplateValidator $validator
     */
    public function __construct(MailerTemplateRepository $repository, MailerTemplateValidator $validator)
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
     * @param  MailerTemplateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MailerTemplateCreateRequest $request)
    {
        $data = $request->all();
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $file_name = md5(date("D M j G:i:s T Y"));
            $template = fopen(resource_path('views/mails/' . $file_name . '.blade.php'), 'w') or die("Permission deined");
            fwrite($template, $data['content']);
            fclose($template);
            $mailerTemplate =MailerTemplate::create([
                'file_name' => $file_name,
                'file_path' => resource_path('views/mails/' . $file_name . '.blade.php'),
                'created_by' => \Auth::user()->id,
            ]);

            $response = [
                'message' => 'MailerTemplate created.',
                'data' => $mailerTemplate->toArray(),
            ];

            return $response;
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);
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
        return $this->repository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  MailerTemplateUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MailerTemplateUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mailerTemplate = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MailerTemplate updated.',
                'data' => $mailerTemplate->toArray(),
            ];


            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

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
        return response()->json([
            'message' => 'MailerTemplate deleted.',
            'deleted' => $deleted,
        ]);
    }
}

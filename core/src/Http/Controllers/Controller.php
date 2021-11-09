<?php

namespace Kizi\Core\Http\Controllers;


use Illuminate\Http\Response;
use Validator;

class BaseController extends \Laravel\Lumen\Routing\Controller
{
}

class Controller extends BaseController
{
    public $messages = [
        'required'       => 'The :attribute field is required.',
        'integer'        => 'The :attribute field is integer.',
        'boolean'        => 'The :attribute field is boolean.',
        'numeric'        => 'The :attribute field is numeric.',
        'array'          => 'The :attribute field is array.',
        'exists'         => 'The :attribute field is not exists.',
        'unique'         => 'The :attribute field is already exists.',
        'same'           => 'The :attribute and :other must match.',
        'size'           => 'The :attribute must be exactly :size.',
        'between'        => 'The :attribute value :input is not between :min - :max.',
        'in'             => 'The :attribute must be one of the following types: :values',
        'date_format'    => 'The :attribute field is wrong format :format',
        'after'          => 'The :attribute must be less than :date',
        'after_or_equal' => 'The :attribute field must be less than or equal values :date field',
        'email'          => 'The :attribute field must be format email',
    ];
    public $request;
    public $repository;

    protected function validation(array $validator = [])
    {
        $this->validate(request(), $validator, $this->messages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkRepository($this->repository);
        $result = $this->repository->getList(request()->all());

        return response_api($result);
    }

    protected function validateStore()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validateStore();
        $this->checkRepository($this->repository);
        $result = $this->repository->create(request()->all());

        return response_api(
            $result,
            Response::HTTP_OK,
            __('core.actions.create_success')
        );
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
        $this->checkRepository($this->repository);
        $result = $this->repository->show($id);

        return response_api($result);
    }

    protected function validateUpdate($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validateUpdate($id);
        $this->checkRepository($this->repository);
        $this->repository->find($id);
        $result = $this->repository->update(request()->all(), $id);

        return response_api($result);
    }

    /**
     * Destroy resources by given ids.
     *
     * @param  string $ids
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->checkRepository($this->repository);
        $this->repository->delete($id);

        return response_api(__('core.actions.delete_success'));
    }

    /**
     * Get repository object
     *
     * @param  reposity $reposity
     *
     * @return boolean
     */
    protected function checkRepository($repository)
    {
        if ( ! isset($repository) || $repository == null) {
            throw new \Exception(__('core.actions.repository_not_exists'));
        }
    }
}

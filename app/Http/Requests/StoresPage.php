<?php

namespace App\Http\Requests;

use App\Page;
use App\Utilities\PageHelpers;
use Illuminate\Foundation\Http\FormRequest;

class StoresPage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'string|max:250|required',
            'path'         => 'string|max:500|nullable',
            'description'  => 'string|max:500',
            'main_content' => 'string',
            'active'       => 'boolean',
        ];
    }

    public function store()
    {

        $page_helper = new PageHelpers;

        $active_status = auth()->user()->is_admin ? $this->active : 0;

        $page = Page::create([
            'name'         => $this->name, 
            'path'         => $page_helper->preparePath( $this->name, $this->path ),
            'description'  => $this->description, 
            'main_content' => $this->main_content, 
            'created_by'   => auth()->id(),
            'active'       => $active_status,
        ]);

        return $page;
    }
}

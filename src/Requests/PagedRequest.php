<?php
namespace Api\StarterKit\Requests;

use Api\StarterKit\Utils\Constants;
use Illuminate\Foundation\Http\FormRequest;

class PagedRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $pageKey = Constants::getParameterKeyPage();
        $pageSizeKey = Constants::getParameterKeyPageSize();
        $page = $this->get($pageKey);
        $pageSize = $this->get($pageSizeKey);

        $page = intval($page);
        $pageSize = intval($pageSize);

        if ($page < 1) {
            $page = Constants::getDefaultPage();
            $this->query->set($pageKey, $page);
        }

        if ($pageSize <= 0) {
            $pageSize = Constants::getDefaultLimit();
            $this->query->set($pageSizeKey, $pageSize);
        }

        // force current page to $page
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

}
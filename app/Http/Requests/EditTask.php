<?php

namespace App\Http\Requests;

use App\Task;

use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));
        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function message()
    {
        $message = parent::messages();

        $status_labels = array_map(function ($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $message + [
            'status.in' => ':attribute には ' . $status_labels . ' のいずれかを指定してください。',
        ];
    }
}

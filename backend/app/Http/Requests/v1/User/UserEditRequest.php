<?php

namespace App\Http\Requests\v1\User;

class UserEditRequest extends UserBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules_base = parent::rules();
        $rules_new = [
            'email' => 'required|email|unique:users,email,'.$this->id,
        ];
        $rules = array_merge($rules_base, $rules_new);
        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        $messages_base = parent::messages();
        $messages_new = [
            //
        ];
        $messages = array_merge($messages_base, $messages_new);
        return $messages;
    }
}

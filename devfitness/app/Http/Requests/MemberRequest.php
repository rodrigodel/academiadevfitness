<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class MemberRequest
 *
 * Esta classe lida com a validação dos dados de entrada para a criação ou atualização de membros.
 * As regras de validação e mensagens de erro personalizadas estão definidas aqui.
 */

class MemberRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Lida com falhas de validação e retorna uma resposta JSON.
     *
     * @param Validator $validator O validador que contém as regras e os erros.
     * @throws HttpResponseException Sempre que a validação falha.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Falha na validação dos dados',
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Define as regras de validação para a requisição.
     *
     * @return array As regras de validação
     */
    public function rules(): array
    {
        // Obter o ID do membro que está sendo atualizado
        $memberId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $memberId,
            'cpf' => 'required|string|size:11|unique:members,cpf,' . $memberId,
            'phone' => 'required|string|size:11',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|string|in:male,female,other',
        ];
    }

    /**
     * Mensagens de erro personalizadas para as regras de validação.
     *
     * @return array As mensagens de erro
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais do que 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais do que 255 caracteres.',
            'email.unique' => 'O email já está registrado.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma string.',
            'cpf.size' => 'O campo CPF deve ter exatamente 11 dígitos.',
            'cpf.unique' => 'O CPF já está registrado.',

            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O campo telefone deve ser uma string.',
            'phone.size' => 'O campo telefone deve ter exatamente 11 dígitos.',

            'date_of_birth.date' => 'O campo data de nascimento deve ser uma data válida.',

            'gender.required' => 'O campo gênero é obrigatório.',
            'gender.string' => 'O campo gênero deve ser uma string.',
            'gender.in' => 'O campo gênero deve ser um dos seguintes valores: male, female, other.',
        ];
    }
}


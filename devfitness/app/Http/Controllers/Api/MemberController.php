<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Requests\MemberRequest; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; // Importa a classe correta Request

class MemberController extends Controller
{
    /**
     * Listar todos os membros da academia.
     *
     * @authenticated
     * 
     * Endpoint: [GET] https://rodrigozambon.com.br/devfitness/api/members
     * @group Members
     * @queryParam page O número da página. Exemplo: page=1
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $members = Member::orderBy('name', 'asc')->paginate(5);

        return response()->json([
            'status' => true,
            'members' => $members,
        ], 200);
    }

    /**
    * Mostrar um membro específico da academia pelo ID.
    *
    * @authenticated
    *
    * Endpoint: [GET] https://rodrigozambon.com.br/devfitness/api/members/{id}
    *
    * @group Members
    * @urlParam id integer required O ID do membro. Exemplo: 1
    *
    * @return JsonResponse
    */
    public function show($id): JsonResponse
    {
        // Busca o membro pelo ID
        $member = Member::find($id);

        // Verifica se o membro existe
        if ($member) {
            return response()->json([
                'status' => true,
                'member' => $member,
            ], 200);
        } else {
            // Retorna erro 404 se o membro não for encontrado
            return response()->json([
                'status' => false,
                'message' => 'Member not found',
            ], 404);
        }
    }

    /**
     * Cadastrar um novo membro.
     * 
     * @authenticated
     *
     * Endpoint: [POST] https://rodrigozambon.com.br/devfitness/api/members
     *
     * @group Members
     * @bodyParam name string required Nome do membro. Exemplo: "Carlos D."
     * @bodyParam email string required Email do membro. O email deve ser único e não pode já existir no banco de dados. Exemplo: "carlos@alunodevfitness.com"
     * @bodyParam cpf string required CPF do membro (11 dígitos). O CPF deve ser único e não pode já existir no banco de dados. Exemplo: "12345678901"
     * @bodyParam phone string required Telefone do membro (11 dígitos). Exemplo: "12345678901"
     * @bodyParam date_of_birth date Data de nascimento do membro (opcional). Exemplo: "1990-05-15"
     * @bodyParam gender string required Gênero do membro (male, female, other). Exemplo: "male"
     * 
     * @note O email e o CPF precisam ser únicos no sistema. Tentar cadastrar um membro com o mesmo email ou CPF já existente resultará em erro de validação.
     *
     * @return JsonResponse
     */
    public function store(MemberRequest $request): JsonResponse
    {
        try {
            // Obter os dados validados
            $validatedData = $request->validated();

            // Verifica se já existe um membro com o mesmo CPF, e se sim, atualiza o registro
            $member = Member::updateOrCreate(
                ['cpf' => $validatedData['cpf']], // Condição para verificar o CPF
                $validatedData // Atualiza ou cria com os dados validados
            );

            // Retorna resposta JSON com o membro criado ou atualizado
            return response()->json([
                'status' => true,
                'message' => 'Member created or updated successfully',
                'member' => $member,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retorna os erros de validação
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Atualizar um membro existente.
     * 
     * @authenticated
     *
     * Endpoint: [PUT] https://rodrigozambon.com.br/devfitness/api/members/{id}
     *
     * @group Members
     * @urlParam id integer required O ID do membro a ser atualizado. Exemplo: 1
     * @bodyParam name string required Nome do membro. Exemplo: "Carlos D. Updated"
     * @bodyParam email string required Email do membro. O email deve ser único. Exemplo: "carlos.updated@alunodevfitness.com"
     * @bodyParam cpf string required CPF do membro (11 dígitos). Exemplo: "12345678901"
     * @bodyParam phone string required Telefone do membro (11 dígitos). Exemplo: "12345678901"
     * @bodyParam date_of_birth date Data de nascimento do membro (opcional). Exemplo: "1990-05-15"
     * @bodyParam gender string required Gênero do membro (male, female, other). Exemplo: "male"
     *
     * @param MemberRequest $request
     * @param int $id O ID do membro a ser atualizado.
     * @return JsonResponse
     */
    public function update(MemberRequest $request, $id): JsonResponse
    {
        // Encontra o membro pelo ID
        $member = Member::find($id);

        // Verifica se o membro existe
        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Membro não encontrado',
            ], 404);
        }

        // Obter os dados validados
        $validatedData = $request->validated();

        // Atualiza os dados do membro
        $member->update($validatedData);

        // Retorna resposta JSON com o membro atualizado
        return response()->json([
            'status' => true,
            'message' => 'Membro atualizado com sucesso',
            'member' => $member,
        ], 200);
    }

    /**
     * Deletar um membro existente.
     * 
     * @authenticated
     *
     * Endpoint: [DELETE] https://rodrigozambon.com.br/devfitness/api/members/{id}
     *
     * @group Members
     * @urlParam id integer required O ID do membro a ser deletado. Exemplo: 1
     *
     * @param int $id O ID do membro a ser deletado.
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Encontra o membro pelo ID
        $member = Member::find($id);

        // Verifica se o membro existe
        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Membro não encontrado',
            ], 404);
        }

        // Deleta o membro
        $member->delete();

        // Retorna resposta JSON confirmando a exclusão
        return response()->json([
            'status' => true,
            'message' => 'Membro deletado com sucesso',
        ], 200);
    }

    /**
     * Listar todos os pagamentos de um membro específico da academia.
     * 
     * @authenticated
     * 
     */
    public function payments($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['message' => 'Membro não encontrado'], 404);
        }

        // Obtém todos os pagamentos relacionados a este membro
        $payments = $member->payments;

        return response()->json($payments, 200);
    }

    /**
     * Listar todos os planos de um membro específico da academia se estão ativos ou inativos.
     * 
     * @authenticated
     * 
     */
    public function plans($id)
    {
    $member = Member::find($id);

    if (!$member) {
        return response()->json(['message' => 'Membro não encontrado'], 404);
    }

    // Obtém todos os planos relacionados a este membro
    $plans = $member->plans;

    return response()->json($plans, 200);
    }

}


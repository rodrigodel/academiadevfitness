<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Listar todos os pagamentos de um membro.
     * 
     * Retorna todos os pagamentos associados a um membro específico.
     * 
     * @group Payments
     * @urlParam memberId integer required O ID do membro. Exemplo: 1
     * @response 200 {
     *   "id": 1,
     *   "member_id": 1,
     *   "date": "2024-09-20",
     *   "status": "paid",
     *   "payment_method": "credit_card"
     * }
     */
    public function index($memberId)
    {
        $payments = Payment::where('member_id', $memberId)->get();
        return response()->json($payments);
    }

    /**
     * Exibir um pagamento específico.
     * 
     * Retorna um pagamento específico, incluindo o membro associado.
     * 
     * @group Payments
     * @urlParam id integer required O ID do pagamento. Exemplo: 1
     * @response 200 {
     *   "id": 1,
     *   "member_id": 1,
     *   "date": "2024-09-20",
     *   "status": "paid",
     *   "payment_method": "credit_card"
     * }
     * @response 404 {
     *   "message": "Pagamento não encontrado"
     * }
     */
    public function show($id)
    {
        $payment = Payment::with('member')->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Pagamento não encontrado'], 404);
        }

        return response()->json($payment);
    }

    /**
     * Criar um novo pagamento.
     * 
     * Registra um novo pagamento no sistema.
     * 
     * @group Payments
     * @bodyParam member_id integer required O ID do membro. Exemplo: 1
     * @bodyParam date date required A data do pagamento. Exemplo: 2024-09-20
     * @bodyParam status string required O status do pagamento. Exemplo: "paid"
     * @bodyParam payment_method string required O método de pagamento. Exemplo: "credit_card"
     * @response 201 {
     *   "id": 1,
     *   "member_id": 1,
     *   "date": "2024-09-20",
     *   "status": "paid",
     *   "payment_method": "credit_card"
     * }
     */
    public function store(Request $request)
    {
        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }

    /**
     * Atualizar um pagamento.
     * 
     * Atualiza os dados de um pagamento existente.
     * 
     * @group Payments
     * @urlParam id integer required O ID do pagamento a ser atualizado. Exemplo: 1
     * @bodyParam member_id integer O ID do membro. Exemplo: 1
     * @bodyParam date date A data do pagamento. Exemplo: 2024-09-20
     * @bodyParam status string O status do pagamento. Exemplo: "paid"
     * @bodyParam payment_method string O método de pagamento. Exemplo: "credit_card"
     * @response 200 {
     *   "id": 1,
     *   "member_id": 1,
     *   "date": "2024-09-20",
     *   "status": "paid",
     *   "payment_method": "credit_card"
     * }
     * @response 404 {
     *   "message": "Pagamento não encontrado"
     * }
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json(['message' => 'Pagamento não encontrado'], 404);
        }

        $payment->update($request->all());
        return response()->json($payment);
    }

    /**
     * Deletar um pagamento.
     * 
     * Exclui um pagamento existente do sistema.
     * 
     * @group Payments
     * @urlParam id integer required O ID do pagamento a ser deletado. Exemplo: 1
     * @response 200 {
     *   "message": "Pagamento deletado com sucesso"
     * }
     * @response 404 {
     *   "message": "Pagamento não encontrado"
     * }
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Pagamento não encontrado'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Pagamento deletado com sucesso']);
    }
}

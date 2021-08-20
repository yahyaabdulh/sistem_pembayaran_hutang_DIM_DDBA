<?php

namespace App\Controllers;

use App\Models\Purchases;
use App\Models\Payments;
use App\Models\PaymentDetails;
use App\Models\Suppliers;


class Payment extends BaseController
{
	public function index()
	{
		$payments = new Payments();
		$data['payments'] = $payments->select('payments.*,suppliers.name as supplier_name')
			->join('suppliers', 'suppliers.id = payments.supplier_id')
			->paginate(5, 'payments');
		$data['pager'] = $payments->pager;
		$data['nomor'] = nomor($this->request->getVar('page_payments'), 5);
		return view('payments/index', $data);
	}

	public function create()
	{
		$suppliers = new Suppliers();
		$purchases = new Purchases();
		$data['suppliers'] = $suppliers->select('name, id')->findAll();
		$data['purchases'] = $purchases->select('code, id, grand_total')->findAll();
		return view('payments/create', $data);
	}

	public function store()
	{
		if (!$this->validate([
			'code' => [
				'rules' => 'required|min_length[4]|max_length[225]|is_unique[payments.code]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 225 Karakter',
					'is_unique' => 'Kode sudah digunakan sebelumnya'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
       // var_dump(json_encode($this->request->getPost()));
		$payments = new Payments();
		$payments->insert([
			'code' => $this->request->getPost('code'),
			'date' => $this->request->getPost('date'),
			'supplier_id' => $this->request->getPost('supplier_id'),
			'bill_amount' => $this->request->getPost('bill_amount'),
			'paid_amount' => $this->request->getPost('paid_amount'),
			'status' => 1,
			'note' => $this->request->getPost('note'),
			'user_create' => session()->get('username')
		]);
		$header_id =  $payments->insertID();
		$jumlah = count($this->request->getPost('purchase_id'));
		for ($i = 0; $i < $jumlah; $i++) {
			$data = array(
				'header_id' => $header_id,
				'purchase_id' => $this->request->getPost('purchase_id')[$i],
				'bill' => $this->request->getPost('bill')[$i],
				'bill_payment' => $this->request->getPost('bill_payment')[$i],
				'bill_remain' => $this->request->getPost('bill_remain')[$i],
				'note' => $this->request->getPost('note_detail')[$i],
			);
			$payment_d = new PaymentDetails();
			$payment_d->insert($data);
		}
		
		session()->setFlashdata('message', 'Tambah Data Pembayaran Berhasil');
		return redirect()->to('/pembayaran');
	}

	function delete($id)
    {
		$payments = new Payments();
		$payment_d = new PaymentDetails();
		$payment_d->where('header_id', $id)->delete();
        $payments->delete($id);
        session()->setFlashdata('message', 'Hapus Data Pembayaran Berhasil');
        return redirect()->to('/pembayaran');
    }
}

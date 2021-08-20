<?php

namespace App\Controllers;

use App\Models\Purchases;
use App\Models\PurchaseDetails;
use App\Models\Suppliers;


class Purchase extends BaseController
{
	public function index()
	{
		$purchases = new Purchases();
		$data['purchases'] = $purchases->select('purchases.*,suppliers.name as supplier_name')
			->join('suppliers', 'suppliers.id = purchases.supplier_id')
			->paginate(5, 'purchases');
		$data['pager'] = $purchases->pager;
		$data['nomor'] = nomor($this->request->getVar('page_purchases'), 5);
		return view('purchases/index', $data);
	}

	public function create()
	{
		$suppliers = new Suppliers();
		$data['suppliers'] = $suppliers->select('name, id')->findAll();
		return view('purchases/create', $data);
	}

	public function store()
	{
		if (!$this->validate([
			'code' => [
				'rules' => 'required|min_length[4]|max_length[225]|is_unique[purchases.code]',
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

		$purchases = new Purchases();
		$purchases->insert([
			'code' => $this->request->getPost('code'),
			'date' => $this->request->getPost('date'),
			'supplier_id' => $this->request->getPost('supplier_id'),
			'sub_total' => $this->request->getPost('sub_total'),
			'disc_percent' => $this->request->getPost('disc_percent'),
			'disc_amount' => $this->request->getPost('disc_amount'),
			'grand_total' => $this->request->getPost('grand_total'),
			'status' => 1,
			'note' => $this->request->getPost('note'),
			'user_create' => session()->get('username')
		]);
		$header_id =  $purchases->insertID();
		$jumlah = count($this->request->getPost('item_name'));
		for ($i = 0; $i < $jumlah; $i++) {
			$data = array(
				'header_id' => $header_id,
				'item_name' => $this->request->getPost('item_name')[$i],
				'qty' => $this->request->getPost('qty')[$i],
				'price' => $this->request->getPost('price')[$i],
				'disc_percent_d' => $this->request->getPost('disc_percent_d')[$i],
				'disc_amount_d' => $this->request->getPost('disc_amount_d')[$i],
				'total_price' => $this->request->getPost('total_price')[$i],
			);
			$purchase_d = new PurchaseDetails();
			$purchase_d->insert($data);
		}
		
		session()->setFlashdata('message', 'Tambah Data Pembelian Berhasil');
		return redirect()->to('/pembelian');
	}

	function delete($id)
    {
		$purchases = new Purchases();
		$purchase_d = new PurchaseDetails();
		$purchase_d->where('header_id', $id)->delete();
        $purchases->delete($id);
        session()->setFlashdata('message', 'Hapus Data Pembelian Berhasil');
        return redirect()->to('/pembelian');
    }
}

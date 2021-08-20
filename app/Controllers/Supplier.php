<?php

namespace App\Controllers;

use App\Models\Suppliers;


class Supplier extends BaseController
{
	public function index()
	{
		$suppliers = new Suppliers();
		$data['suppliers'] = $suppliers->paginate(5, 'suppliers');
		$data['pager'] = $suppliers->pager;
		$data['nomor'] = nomor($this->request->getVar('page_suppliers'), 5);
		return view('suppliers/index', $data);
	}

	public function create()
	{
		return view('suppliers/create');
	}

	public function store()
	{
		if (!$this->validate([
			'code' => [
				'rules' => 'required|min_length[4]|max_length[225]|is_unique[suppliers.code]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 225 Karakter',
					'is_unique' => 'Kode sudah digunakan sebelumnya'
				]
			],
			'name' => [
				'rules' => 'required|min_length[4]|max_length[225]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 225 Karakter',
				]
			],
			'tlp' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Harus diisi'
				]
			],
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} Harus diisi',
					'valid_email' => 'Email Harus Valid'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
		$suppliers = new Suppliers();
		$suppliers->insert([
			'code' => $this->request->getVar('code'),
			'name' => $this->request->getVar('name'),
			'tlp' => $this->request->getVar('tlp'),
			'tlp2' => $this->request->getVar('tlp2'),
			'fax' => $this->request->getVar('fax'),
			'email' => $this->request->getVar('email'),
			'address' => $this->request->getVar('address'),
			'note' => $this->request->getVar('note'),
			'is_active' => $this->request->getVar('is_active') ? 1 : 0,
		]);
		session()->setFlashdata('message', 'Tambah Data Supplier Berhasil');
		return redirect()->to('/supplier');
	}

	function edit($id)
	{
		$suppliers = new Suppliers();
		$dataSup = $suppliers->find($id);
		if (empty($dataSup)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Supplier Tidak ditemukan !');
		}
		$data['suppliers'] = $dataSup;
		return view('suppliers/edit', $data);
	}

	public function update($id)
	{
		if (!$this->validate([
			'code' => [
				'rules' => 'required|min_length[4]|max_length[225]|is_unique[suppliers.code, id, '.$id.']',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 225 Karakter',
					'is_unique' => 'Kode sudah digunakan sebelumnya'
				]
			],
			'name' => [
				'rules' => 'required|min_length[4]|max_length[225]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 225 Karakter',
				]
			],
			'tlp' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Harus diisi'
				]
			],
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} Harus diisi',
					'valid_email' => 'Email Harus Valid'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
		$suppliers = new Suppliers();
		$suppliers->update($id, [
			'code' => $this->request->getVar('code'),
			'name' => $this->request->getVar('name'),
			'tlp' => $this->request->getVar('tlp'),
			'tlp2' => $this->request->getVar('tlp2'),
			'fax' => $this->request->getVar('fax'),
			'email' => $this->request->getVar('email'),
			'address' => $this->request->getVar('address'),
			'note' => $this->request->getVar('note'),
			'is_active' => $this->request->getVar('is_active') ? 1 : 0,
		]);
		session()->setFlashdata('message', 'Update Data Supplier Berhasil');
		return redirect()->to('/supplier');
	}

	function delete($id)
    {
		$suppliers = new Suppliers();
        $suppliers->delete($id);
        session()->setFlashdata('message', 'Hapus Data Supplier Berhasil');
        return redirect()->to('/supplier');
    }
}

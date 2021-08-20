<?php
namespace App\Controllers;

use App\Models\Users;

 
class User extends BaseController
{
	public function index()
	{
		$users = new Users();
		$data['users'] = $users->orderBy('created_at', 'DESC')->paginate(5, 'users');
		$data['pager'] = $users->pager;
		$data['nomor'] = nomor($this->request->getVar('page_users'), 5);
		return view('users/index', $data);
	}

	public function create()
	{
		return view('users/create');
	}

	public function store()
	{
		if (!$this->validate([
			'username' => [
				'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 20 Karakter',
					'is_unique' => 'Username sudah digunakan sebelumnya'
				]
			],
			'password' => [
				'rules' => 'required|min_length[4]|max_length[50]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 50 Karakter',
				]
			],
			'password_conf' => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'Konfirmasi Password tidak sesuai dengan password',
				]
			],
			'name' => [
				'rules' => 'required|min_length[4]|max_length[100]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 100 Karakter',
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
			'address' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Harus diisi'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
		$users = new Users();
		$users->insert([
			'username' => $this->request->getVar('username'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'name' => $this->request->getVar('name'),
			'tlp' => $this->request->getVar('tlp'),
			'email' => $this->request->getVar('email'),
			'address' => $this->request->getVar('address')
		]);
		session()->setFlashdata('message', 'Tambah Data Pengguna Berhasil');
		return redirect()->to('/pengguna');
	}

	function edit($id)
	{
		$users = new Users();
		$dataUser = $users->find($id);
		if (empty($dataUser)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pengguna Tidak ditemukan !');
		}
		$data['users'] = $dataUser;
		return view('users/edit', $data);
	}

	public function update($id)
	{
		if (!$this->validate([
			'password' => [
				'rules' => 'required|min_length[4]|max_length[50]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 50 Karakter',
				]
			],
			'password_conf' => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'Konfirmasi Password tidak sesuai dengan password',
				]
			],
			'name' => [
				'rules' => 'required|min_length[4]|max_length[100]',
				'errors' => [
					'required' => '{field} Harus diisi',
					'min_length' => '{field} Minimal 4 Karakter',
					'max_length' => '{field} Maksimal 100 Karakter',
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
			'address' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Harus diisi'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}

		$users = new Users();
		$users->update($id, [
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'name' => $this->request->getVar('name'),
			'tlp' => $this->request->getVar('tlp'),
			'email' => $this->request->getVar('email'),
			'address' => $this->request->getVar('address')
		]);
		session()->setFlashdata('message', 'Update Data Pengguna Berhasil');
		return redirect()->to('/pengguna');
	}

	function delete($id)
    {
		$users = new Users();
        $users->delete($id);
        session()->setFlashdata('message', 'Hapus Data Pengguna Berhasil');
        return redirect()->to('/pengguna');
    }
}

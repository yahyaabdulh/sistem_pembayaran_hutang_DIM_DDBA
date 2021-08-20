<?php

namespace App\Controllers;

use App\Models\Purchases;
use App\Models\PurchaseDetails;
use App\Models\Suppliers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{
    private $db;
  
    public function __construct()
    {
        $this->db = db_connect(); 
        
    }

    public function index()
    {
        $suppliers = new Suppliers();
        $data['suppliers'] = $suppliers->select('name, id')->findAll();
        return view('reports/payable', $data);
    }

    public function export()
    {
        $where = '';
        if($_GET['date_1'] && $_GET['date_2']){
            $where .= 'date(p.date)>="'.$_GET['date_1'].'" and date(p.date)<="'.$_GET['date_2'].'" and ';
        }
        if($_GET['supplier_id']){
            $where .= 'p.supplier_id='.$_GET['supplier_id'].' and ';
        }
        $where = $where ? 'where '.substr($where, 0, -4) : '';
        $sql = 'select
                s.code,
                s.name,
                s.address,
                s.email,
                sum( p.grand_total ) AS payable_total,
                count(p.id) as purchase_count,
                ifnull( sum( x.payable_payment ), 0 ) AS payable_payment,
                count(x.payment_count) as payment_count,
                sum( p.grand_total ) - ifnull( sum( x.payable_payment ), 0 ) AS payable_balance 
            from
                purchases AS p
                LEFT JOIN suppliers AS s ON s.id = p.supplier_id
                LEFT JOIN (
            select
                p.purchase_id,
                ifnull( sum( p.bill_payment ), 0 ) AS payable_payment,
                count(p.id) as payment_count
            from
                payment_details AS p 

            group by
                p.purchase_id 
                ) AS x ON x.purchase_id = p.id 
                '.$where.'
            group by
                s.code,
                s.name,
                s.address,
                s.email';
        $p = $this->db->query($sql);
        $p = $p->getResult();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode')
            ->setCellValue('B1', 'Supplier')
            ->setCellValue('C1', 'Alamat')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Total Hutang')
            ->setCellValue('F1', 'Jumlah Pembelian')
            ->setCellValue('G1', 'Total Pembayaran')
            ->setCellValue('H1', 'Jumlah Pembayaran')
            ->setCellValue('I1', 'Saldo Hutang');

        $column = 2;
        foreach ($p as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data->code)
                ->setCellValue('B' . $column, $data->name)
                ->setCellValue('C' . $column, $data->address)
                ->setCellValue('D' . $column, $data->email)
                ->setCellValue('E' . $column, $data->payable_total)
                ->setCellValue('F' . $column, $data->purchase_count)
                ->setCellValue('G' . $column, $data->payable_payment)
                ->setCellValue('H' . $column, $data->payment_count)
                ->setCellValue('I' . $column, $data->payable_balance);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Pembayaran Hutang.xlsx';

        // Redirect hasil generate xlsx ke web client
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        // header('Cache-Control: max-age=0');

        $writer->save($fileName);
        session()->setFlashdata('message', 'Export Laporan Pembayaran Hutang Berhasil');
        return  redirect()->to('/laporan_hutang');
    }
}

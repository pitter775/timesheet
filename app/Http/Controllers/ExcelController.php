<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        // Criar uma nova planilha
        $spreadsheet = new Spreadsheet();

        // Criar uma nova aba (guia) com nome 'Aba 1'
        $sheet1 = $spreadsheet->createSheet(0, 'Aba 1');

        // Adicionar conteúdo à aba 1
        $sheet1->setCellValue('A1', 'Valor 1');
        $sheet1->setCellValue('B1', 'Valor 2');

        // Criar uma nova aba (guia) com nome 'Aba 2'
        $sheet2 = $spreadsheet->createSheet(1, 'Aba 2');

        // Adicionar conteúdo à aba 2
        $sheet2->setCellValue('A1', 'Valor 3');
        $sheet2->setCellValue('B1', 'Valor 4');
        $sheet2->setCellValue('C1', 'Valor 33');

        // Salvar a planilha em um stream
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $stream = fopen('php://temp', 'r+');
        $writer->save($stream);
        rewind($stream);

        // Retornar uma resposta HTTP com a planilha anexada
        $response = new Response(stream_get_contents($stream), 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="planilha.xlsx"',
        ]);
        fclose($stream);

        return $response;
    }
}

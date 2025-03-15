<?php
require_once '../vendor/autoload.php';
require_once '../koneksi.php';

$mpdf = new \Mpdf\Mpdf();
$id = $_GET['idPrint'];
$select = mysqli_query($conn, "SELECT * FROM resume WHERE id=$id");
$row = mysqli_fetch_assoc($select);

$html = '
    <table border="1">
        <tr>
            <th>No. </th>
            <td>1. </td>
        </tr>
        <tr>
            <th> Tahun Awal </th>
            <td>'. $row["tahun_awal"] . '</td>
        </tr>
        <tr>
            <th> Tahun Akhir </th>
            <td>'. $row["tahun_akhir"] . '</td>
        </tr>
        <tr>
            <th> Skill </th>
            <td>'. $row["skill"] . '</td>
        </tr>
        <tr>
            <th> Instansi </th>
            <td>'. $row["instansi"] . '</td>
        </tr>
        <tr>
            <th> Deskripsi </th>
            <td>'. $row["deskripsi"] . '</td>
        </tr>
    </table>
    ';


$mpdf->WriteHTML($html);
$mpdf->Output();
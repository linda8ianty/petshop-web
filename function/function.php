<?php
function tanggal_eng($date) {
    $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    $bulan = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];

    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $time = substr($date, 11, 5);
    $day = date("w", strtotime($date));

    // $result = $hari[$day] . ", " . $tgl . " " . $bulan[(int)$month-1] . " " . $year . " " . $time . " WIB";
    $result = $bulan[(int)$month-1] . " " . $tgl;
    return $result;
}

function tanggal_indo($date) {
    $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $time = substr($date, 11, 5);
    $day = date("w", strtotime($date));

    $result = $hari[$day] . ", " . $tgl . " " . $bulan[(int)$month-1] . " " . $year . " " . $time . " WIB";
    return $result;
}
?>

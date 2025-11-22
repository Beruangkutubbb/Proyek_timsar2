<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penggajian_cirebon";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ====== IMPORT DATA CSV OTOMATIS (HANYA JIKA BELUM ADA DATA) ======
$check = $conn->query("SELECT COUNT(*) as total FROM karyawan");
$row = $check->fetch_assoc();

if ($row['total'] == 0) {
    $csvFile = __DIR__ . '/../data/penggajian_karyawan_cirebon.csv';
    if (file_exists($csvFile)) {
        $file = fopen($csvFile, 'r');
        fgetcsv($file); // skip baris header pertama

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            $employee_id = $conn->real_escape_string($data[0]);
            $name = $conn->real_escape_string($data[1]);
            $sector = $conn->real_escape_string($data[2]);
            $job_level = $conn->real_escape_string($data[3]);
            $experience_years = (int)$data[4];
            $basic_salary = (float)$data[5];
            $allowance = (float)$data[6];
            $overtime = (float)$data[7];
            $total = (float)$data[8];
            $location = $conn->real_escape_string($data[9]);
            $source = $conn->real_escape_string($data[10]);
            $created_at = $conn->real_escape_string($data[11]);

            // Masukkan ke tabel karyawan
            $conn->query("INSERT INTO karyawan 
                (employee_id, name, sector, job_level, experience_years, basic_salary_idr, allowance_idr, overtime_idr, total_compensation_idr, location, source, created_at)
                VALUES 
                ('$employee_id', '$name', '$sector', '$job_level', $experience_years, $basic_salary, $allowance, $overtime, $total, '$location', '$source', '$created_at')");

            // Masukkan ke tabel penggajian otomatis
            $bulan = date('m');
            $tahun = date('Y');
            $potongan = 0;
            $total_gaji = $total;

            $conn->query("INSERT INTO penggajian (employee_id, bulan, tahun, potongan, total_gaji)
                VALUES ('$employee_id', '$bulan', '$tahun', $potongan, $total_gaji)");
        }

        fclose($file);
    }
}
?>

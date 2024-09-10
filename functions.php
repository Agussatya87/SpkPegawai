<?php


$con = mysqli_connect("localhost", "root", "", "db_spk");

function login($data)
{
	global $con;

	$username = $data['username'];
	$password = $data['password'];

	$login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password' ");

	return mysqli_affected_rows($con);
}

function query($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tampilkriteria($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function edit_kriteria($data)
{
	global $con;
	$id_kriteria = $data['id_kriteria'];
	$kriteria = $data['kriteria'];
	$bobot = $data['bobot'];
	$type = $data['type'];

	mysqli_query($con, "UPDATE kriteria SET 
		kriteria = '$kriteria',
		bobot = '$bobot',
		type = '$type'
		WHERE id_kriteria = '$id_kriteria'
		");

	return mysqli_affected_rows($con);
}

function tampilcalon($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_calon($data)
{
	global $con;

	$id_calon = $data['id_calon'];
	$nama_calon = $data['nama_calon'];
	$c1 = $data['c1'];
	$c2 = $data['c2'];
	$c3 = $data['c3'];
	$c4 = $data['c4'];
	$c5 = $data['c5'];


	mysqli_query($con, "INSERT INTO calon_staff VALUES ('$id_calon','$nama_calon','$c1','$c2','$c3','$c4','$c5') ");

	return mysqli_affected_rows($con);
}



function edit_calon($data)
{
	global $con;

	$id_calon = $data['id_calon'];
	$nama_calon = $data['nama_calon'];
	$c1 = $data['c1'];
	$c2 = $data['c2'];
	$c3 = $data['c3'];
	$c4 = $data['c4'];
	$c5 = $data['c5'];


	mysqli_query($con, "UPDATE calon_staff SET
						 id_calon = '$id_calon',
						 nama_calon = '$nama_calon',
						 c1 = '$c1',
						 c2 = '$c2',
						 c3 = '$c3',
						 c4 = '$c4',
						 c5 = '$c5'
						 WHERE id_calon = '$id_calon'
						  ");

	return mysqli_affected_rows($con);
}

function hapus_calon($id_calon)
{
	global $con;

	mysqli_query($con, "DELETE FROM calon_staff WHERE id_calon = '$id_calon' ");

	return mysqli_affected_rows($con);
}

function insert_hasil_perankingan($data)
{
	date_default_timezone_set('Asia/Jakarta');
	global $con;

	$kode = $data['kode'];
	$id_calon = $data['id_calon'];
	$nama_calon = $data['nama_calon'];
	$total_hasil = $data['total_hasil'];

	$tanggal = date('d - M - Y | H : i : s');

	if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM nilai WHERE kode_hasil = '$kode' "))) {
		echo "<script>
				alert('Gagal')
				document.location.href='data_calon_staff.php'
			  </script>	";
		exit;
	}




	for ($x = 0; $x < count($nama_calon); $x++) 
		{
		$input = mysqli_query($con, "INSERT INTO nilai VALUES('','$kode','$id_calon[$x]','$nama_calon[$x]','$total_hasil[$x]')");
		}
		if ($input) {
			mysqli_query($con, "INSERT INTO hasil_akhir VALUES('','$kode','$tanggal') ");
		} 
		else {
			echo "<script>alert('Data Gagal Tersimpan Coba Lagi')
					document.location.href='data_calon_staff.php'
				</script>";
		}
	


	return mysqli_affected_rows($con);
}


function hapus_laporan($kode)
{
	global $con;

	mysqli_query($con, "DELETE FROM hasil_akhir WHERE kode = '$kode' ");
	mysqli_query($con, "DELETE FROM nilai WHERE kode_hasil = '$kode' ");

	return mysqli_affected_rows($con);
}

function print_laporan($kode)
{
    global $con;

    // Ambil data laporan berdasarkan kode
    $hasil_akhir = mysqli_query($con, "SELECT * FROM hasil_akhir WHERE kode = '$kode'");
    $data_nilai = mysqli_query($con, "SELECT * FROM nilai WHERE kode_hasil = '$kode' ORDER BY total DESC");

    // Jika data ditemukan
    if (mysqli_num_rows($hasil_akhir) > 0 && mysqli_num_rows($data_nilai) > 0) {
        $hasil_akhir_row = mysqli_fetch_assoc($hasil_akhir);

        // Format data laporan ke dalam bentuk yang siap dicetak
        echo '<div id="laporan">';
        echo '<h2>Laporan Kode: ' . htmlspecialchars($hasil_akhir_row['kode']) . '</h2>';
        echo '<p>Tanggal: ' . htmlspecialchars($hasil_akhir_row['tanggal']) . '</p>';
        echo '<h3>Detail Nilai:</h3>';
        echo '<table border="1" cellpadding="5" cellspacing="0">';
        echo '<tr><th>Rank</th><th>ID Calon</th><th>Nama Calon</th><th>Total Hasil</th></tr>';

        $rank = 1; // Inisialisasi variabel rank
        while ($row = mysqli_fetch_assoc($data_nilai)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($rank++) . '</td>';
            echo '<td>' . htmlspecialchars($row['id_calon']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nama_calon']) . '</td>';
            echo '<td>' . htmlspecialchars($row['total']) . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        echo '</div>';

        // Tambahkan CSS untuk print
        echo '<style>
            @media print {
                body * {
                    visibility: hidden;
                }
                #laporan, #laporan * {
                    visibility: visible;
                }
                #laporan {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }
        </style>';

        // Tambahkan JavaScript untuk print
        echo '<script>
            function printPage() {
                window.print();
            }
            printPage();
        </script>';
    } else {
        echo '<script>alert("Laporan tidak ditemukan.");</script>';
    }
}



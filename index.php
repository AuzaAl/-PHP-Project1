
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Aplikasi Penjualan Sederhana</title>
    <script>
        let counter = 1;
        function tambahInput() {
            if (counter <= 4) {
                
            
            counter++; // penambah counter

            // take container buat wadah input
            const containerName = document.getElementById('name-input-container');
            const containerHarga = document.getElementById('harga-input-container');
            const containerJumlah = document.getElementById('jumlah-input-container');


            // buat input new
            const newInputName = document.createElement('div');
            newInputName.className = 'name-input-group'; // add class
            newInputName.innerHTML = `
                <input type="text" name="barang${counter}" id="barang${counter}" required placeholder="Item ${counter}"><br>
            `;
            const newInputHarga = document.createElement('div');
            newInputHarga.className = 'harga-input-group'; // add class
            newInputHarga.innerHTML = `
                <input type="text" name="harga${counter}" id="harga${counter}" required placeholder="Harga item ${counter}"><br>
            `;
            const newInputJumlah = document.createElement('div');
            newInputJumlah.className = 'jumlah-input-group'; // add class
            newInputJumlah.innerHTML = `
                <input type="text" name="jumlah${counter}" id="jumlah${counter}" required placeholder="Quantity Item ${counter}"><br>
            `;

            // print element child ke html
            containerName.appendChild(newInputName);
            containerHarga.appendChild(newInputHarga);
            containerJumlah.appendChild(newInputJumlah);
            }
        }
    </script>
</head>
<body>
    <main>
    <form method="POST">
    <div class="card">
    <div class="all-input-container">
        <!-- Container untuk input -->
        <label for="barang1">Barang:</label>
        <div id="name-input-container">
            <div class="name-input-group"> <input type="text" name="barang1" id="barang1"  required placeholder="Item 1"><br></div>
        </div><br>
        
        <label for="barang1">Harga:</label>
        <div id="harga-input-container">
            <div id="harga-input-group"> <input type="number" name="harga1" id="harga1" required placeholder="Harga Item 1"><br></div>
        </div><br>

        <label for="barang1">Jumlah:</label>
        <div id="jumlah-input-container">
            <div id="jumlah-input-group"> <input type="number" name="jumlah1" id="jumlah1" required placeholder="Quantity Item 1"><br></div>
        </div>
    </div>
    <div class="button-section">
        <!-- Tombol untuk menambah input -->
        <button id="add-button" type="button" onclick="tambahInput()">+</button>
        <!-- Tombol untuk submit form -->
        <button id="submit-button" type="submit">SUBMIT</button>
        <div>
            
        </div>
        </div>
     </div>
    </form>
    </main>
    <?php
    // PHP script akan ditempatkan di sini untuk memproses data form
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        $barang = [];
        $harga = [];
        $jumlah = [];
        $total = 0;

         for ($i = 1; $i <= 5; $i++) { // Sesuaikan dengan jumlah input maksimal
        if (isset($_POST["barang$i"])) {
            $barang[] = htmlspecialchars($_POST["barang$i"]);
            $harga[] = htmlspecialchars($_POST["harga$i"]);
            $jumlah[] = htmlspecialchars($_POST["jumlah$i"]);
        }
    }
         if (!empty($barang)&& count($harga) > 0 && count($jumlah) > 0) {
                // Hitung total harga
                for ($i = 0; $i < count($barang); $i++) {
                    $total += $harga[$i] * $jumlah[$i];
                }
                
                //arrray to int
                $totalJumlah = array_sum($jumlah);
                // Tampilkan hasil perhitungan

                echo "<h3>Barang:</h3>";
                foreach ($barang as $index => $item) {
                    echo "Ke " . ($index + 1) . ": $item / Harga: Rp " . number_format($harga[$index], 0, ',', '.') . " / Jumlah: $jumlah[$index]<br>";
                }
        
                echo "<h3 style='margin-top: 20px;'>Hasil Perhitungan:</h3>";
                echo "<p>Jumlah Barang: <strong>$totalJumlah</strong></p>";

                if ($totalJumlah > 5) {
                    echo "<p style='color: green;'>Anda mendapatkan diskon 10%!</p>";
                    echo "<p>Harga Barang: Rp "  . number_format($total * 0.9, 0, ',', '.') . "</p>";
                }else{
                    echo "<p>Harga Barang: Rp " . number_format($total, 0, ',', '.') . "</p>";
                }
                
                
            } else {
                echo "<p style='color: red;'>Mohon isi semua kolom dengan benar!</p>";
            }
        }
        
            // Hitung total harga
        //     $total = $harga * $jumlah;
        //     // Tampilkan hasil perhitungan
        //     echo "<h3>Barang :</h3>";
        //     echo "<h3>Hasil Perhitungan:</h3>";
        //     echo "<p>Harga Barang: <strong>Rp total</strong></p>";
        //     echo "<p>Jumlah: <strong>jumlah</strong></p>";

        //     if($jumlah > 5){
        //         echo "<p style='color: green;'>Anda mendapatkan diskon 10%!</p>";
        //     }
        //     echo "<strong>Total Harga: Rp : </strong>"; echo round($total * 0.9);
        // } else {
        //     echo "<p style='color: red;'>Mohon isi semua kolom dengan benar!</p>";


            // echo "<pre>";
            // print_r($totalJumlah);
            // echo "</pre>";
            // echo "<pre>";
            // print_r($harga);
            // echo "</pre>";
            // echo "<pre>";
            // print_r($barang);
            // echo "</pre>";
        
            // echo "<pre>";
            // print_r($i);
            // echo "</pre>";
        
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            
        
    
    ?>

</body>
</html>
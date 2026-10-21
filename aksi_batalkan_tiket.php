<?php 
    session_start();
    include 'koneksi.php';
    
    // Check user sudah login
    if(!isset($_SESSION['email'])){
        header("Location: Login.php");
        exit;
    }
    
    // Handle baik GET maupun POST request
    $tiket_id = 0;
    
    if(isset($_POST['id'])){
        $tiket_id = (int)$_POST['id'];
    } elseif(isset($_GET['id'])){
        $tiket_id = (int)$_GET['id'];
    }
    
    if($tiket_id > 0) {
        // Cek tiket ada atau tidak
        $cekQuery = "SELECT id FROM pesanan_tiket WHERE id = $tiket_id";
        $cekResult = mysqli_query($koneksi, $cekQuery);
        
        if(mysqli_num_rows($cekResult) > 0) {
            // Query untuk delete tiket
            $query = "DELETE FROM pesanan_tiket WHERE id = $tiket_id";
            $result = mysqli_query($koneksi, $query);
            
            if($result && mysqli_affected_rows($koneksi) > 0){
                echo "<script>
                    alert('✓ Tiket berhasil dibatalkan!');
                    window.location.href = 'history_tiket.php';
                </script>";
                exit;
            } else {
                echo "<script>
                    alert('❌ Gagal membatalkan tiket!\\nError: " . mysqli_error($koneksi) . "');
                    window.location.href = 'history_tiket.php';
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('⚠️ Tiket tidak ditemukan!');
                window.location.href = 'history_tiket.php';
            </script>";
            exit;
        }
    } else {
        header("Location: history_tiket.php");
        exit;
    }
?>
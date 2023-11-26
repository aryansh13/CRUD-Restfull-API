const hapusButton = document.getElementById("hapusButton")


hapusButton.addEventListener("submit", function(event){
    const konfirmasi = confirm("Apakah anda ingin menghapus nya?")

    if (konfirmasi == true) {
        header('Location: hapus_data.php')

         // Setelah berhasil menghapus data, tampilkan notifikasi
         const notificationDiv = document.getElementById('notification');
         notificationDiv.innerText = "Data telah berhasil dihapus";
 
         // Hapus pesan notifikasi setelah beberapa waktu (misalnya, 3 detik)
         setTimeout(function() {
             notificationDiv.innerText = "";
            }, 3000);
    }else {
        event.preventDefault();
    }
})





// if(confirm("Apakah anda yakin ingin mengahpus?") == true){
//     header('Location: hapus_data.php')
// }else {
//     header('Location: index.php')
// }
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Presensi Real-Time</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js "></script>
    <style>
        .full-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100vh;
            background-color: #f9f5f6;
            /* Warna latar belakang */
        }

        .img-fluid {
            width: 150px;
            /* Ukuran gambar utama */
            margin-bottom: 10px;
            /* Spasi antara gambar dan teks */
        }

        #notification-container {
            position: relative;
            /* Menjadi kontainer positioning */
            text-align: center;
        }

        .notification-image {
            position: absolute;
            /* Letakkan gambar di atas teks */
            top: 0;
            /* Atur posisi gambar di atas teks */
            left: 0;
            /* Atur posisi gambar ke kiri */
            width: 80px;
            /* Ukuran gambar notifikasi (lebih kecil) */
        }

        .notification-text {
            font-size: 20px;
            font-weight: bold;
            color: green;
            transition: all 0.3s ease-in-out;
            position: relative;
            /* Pastikan teks tidak tertutup oleh gambar */
            z-index: 1;
            /* Prioritas tampilan teks di atas gambar */
        }
    </style>
</head>

<body>

    <div class="full-center">
        <img src="{{ url('assets/icon-home.png') }}" alt="" class="img-fluid">
        <h2 class="header">Silakan lakukan presensi...</h2><br>
        <h3 id="notif" class="notification-text"></h3>
        <div id="notification-container">
            {{-- <img src="" alt="" id="img" class="notification-image"> --}}
        </div>
    </div>

    <script>
        // Inisialisasi Pusher
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // Subscribe ke channel 'rfid'
        const channel = pusher.subscribe('rfid');

        // Tangkap event 'PresensiEvent'
        channel.bind('PresensiEvent', function(data) {
            const status = data.data.status === 'masuk' ? 'Masuk' :
                data.data.status === 'keluar' ? 'Keluar' : 'Tidak Valid';

            let message = '';
            // let imageSrc = '';

            if (data.data.status === 'invalid') {
                message = `UID Tidak Terdaftar - ${data.data.waktu}`;
                // imageSrc = "{{ asset('assets/gagal.png') }}";
                document.getElementById('notif').style.color = 'red';
            } else {
                console.log(data);

                message = `${data.data.nama} - ${data.data.status} pada ${data.data.waktu}`;
                // imageSrc = "{{ asset('assets/sukses.png') }}";
                document.getElementById('notif').style.color = 'green';
            }

            // Hapus konten sebelumnya
            const notifDiv = document.getElementById('notif');
            notifDiv.innerHTML = ''; // Hapus konten lama

            // Tambahkan gambar
            const imgElement = document.createElement('img');
            // imgElement.src = imageSrc;
            imgElement.alt = data.data.status;

            // Tambahkan teks
            const textElement = document.createElement('span');
            textElement.textContent = message;

            // Gabungkan gambar dan teks
            // notifDiv.appendChild(imgElement);
            notifDiv.appendChild(textElement);

            // Reset notifikasi setelah 5 detik
            setTimeout(() => {
                notifDiv.innerHTML = ''; // Hapus konten
                // Kembalikan gambar ke kondisi awal
                document.querySelector('.img-fluid').src = "{{ url('assets/icon-home.png') }}";
            }, 5000);
        });
    </script>

</body>

</html>

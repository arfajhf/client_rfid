@extends('layout.head')
@section('content')
    <h1>Presensi Real-Time</h1>

    <div id="notif" style="font-size: 24px; font-weight: bold; color: green;"></div>

    <script>
        const notifDiv = document.getElementById('notif');

        // Inisialisasi Pusher
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // Subscribe ke channel 'presensi'
        const channel = pusher.subscribe('presensi');

        // Tangkap event PresensiEvent
        channel.bind('PresensiEvent', function(data) {
            const status = data.presensi.status === 'masuk' ? 'Masuk' : 'Keluar';
            const uid = data.presensi.uid;

            notifDiv.innerText = `Absen ${status} Berhasil - UID: ${uid}`;

            setTimeout(() => {
                notifDiv.innerText = '';
            }, 5000);
        });
    </script>
@endsection

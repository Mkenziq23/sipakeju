<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url={{ url('/') }}"> {{-- Redirect setelah 5 detik --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #e0f7fa, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        h1 {
            font-size: 2.2rem;
            color: #2e7d32;
            margin-bottom: 15px;
        }

        p {
            color: #4f4f4f;
            font-size: 1.1rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Terima Kasih 🙏</h1>
        <p>Data Anda telah berhasil kami terima.</p>
        <p>Silakan lanjutkan hari Anda dengan tenang dan penuh semangat.</p>
    </div>
</body>

</html>

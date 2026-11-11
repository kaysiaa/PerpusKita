
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','PerpusKita') · Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #176b55;
            --deep: #104c3d;
            --mint: #eaf5ef;
            --ink: #18352d;
            --muted: #73847d;
            --line: #e4ece7;
            --bg: #f7faf8
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font: 15px 'DM Sans', sans-serif
        }

        a {
            color: inherit;
            text-decoration: none
        }

        .shell {
            display: flex;
            min-height: 100vh
        }

        .side {
            width: 245px;
            background: #fff;
            border-right: 1px solid var(--line);
            padding: 28px 18px;
            position: fixed;
            inset: 0 auto 0 0
        }

        .brand {
            font: 800 21px Manrope;
            color: var(--deep);
            padding: 0 12px 32px
        }

        .brand span {
            color: #77a88f
        }

        .navlabel {
            font-size: 11px;
            color: #9aa9a1;
            font-weight: 700;
            letter-spacing: 1.2px;
            padding: 12px
        }

        .nav a {
            display: block;
            padding: 12px 14px;
            border-radius: 10px;
            color: #65766e;
            margin: 4px 0
        }

        .nav a.active,
        .nav a:hover {
            background: var(--mint);
            color: var(--deep);
            font-weight: 700
        }

        .main {
            margin-left: 245px;
            width: calc(100% - 245px);
            padding: 30px 4.5% 60px
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px
        }

        .top small {
            color: var(--muted)
        }

        h1 {
            font: 800 27px Manrope;
            margin: 0 0 7px
        }

        h2 {
            font: 700 18px Manrope
        }

        .muted {
            color: var(--muted)
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: var(--green);
            color: #fff;
            padding: 11px 16px;
            font: 600 14px 'DM Sans';
            cursor: pointer
        }

        .btn:hover {
            background: var(--deep)
        }

        .btn.light {
            background: var(--mint);
            color: var(--deep)
        }

        .btn.danger {
            background: #fff0ed;
            color: #b74d3c
        }

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 15px;
            padding: 22px;
            margin-bottom: 20px
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 24px 0
        }

        .stat {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px
        }

        .stat small {
            color: var(--muted)
        }

        .stat strong {
            display: block;
            font: 800 28px Manrope;
            margin-top: 9px
        }

        .tablewrap {
            overflow: auto
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px
        }

        th,
        td {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid var(--line)
        }

        th {
            font-size: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px
        }

        td {
            font-size: 14px
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: var(--mint);
            color: var(--deep);
            font-size: 12px;
            font-weight: 700
        }

        .badge.red {
            background: #fff0ed;
            color: #b74d3c
        }

        .field {
            margin-bottom: 16px
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dce6df;
            border-radius: 9px;
            font: 14px 'DM Sans';
            background: #fff;
            color: var(--ink)
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #c8e4d5;
            border-color: var(--green)
        }

        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px
        }

        .alert {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            background: var(--mint);
            color: var(--deep)
        }

        .alert.error {
            background: #fff0ed;
            color: #a53d30
        }

        .actions {
            display: flex;
            gap: 7px;
            align-items: center
        }

        .inline {
            display: inline
        }

        .search {
            display: flex;
            gap: 9px;
            max-width: 470px
        }

        .pagination {
            padding-top: 18px
        }

        .auth {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #eaf5ef, #f8fbf8)
        }

        .authbox {
            width: min(430px, 100%);
            background: #fff;
            padding: 34px;
            border-radius: 18px;
            border: 1px solid var(--line)
        }

        .authbox .brand {
            padding: 0 0 20px
        }

        .footer {
            font-size: 12px;
            color: #98a69f;
            margin-top: 30px
        }

        @media(max-width:850px) {
            .side {
                width: 190px
            }

            .main {
                margin-left: 190px;
                width: calc(100% - 190px);
                padding: 24px
            }

            .stats {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:600px) {
            .side {
                position: static;
                width: 100%;
                height: auto;
                padding: 15px
            }

            .shell {
                display: block
            }

            .brand {
                padding: 0 8px 12px
            }

            .nav {
                display: flex;
                flex-wrap: wrap
            }

            .navlabel {
                display: none
            }

            .nav a {
                padding: 8px 10px
            }

            .main {
                margin: 0;
                width: 100%;
                padding: 20px
            }

            .stats {
                grid-template-columns: 1fr 1fr
            }

            .grid2 {
                grid-template-columns: 1fr
            }

            .top {
                align-items: flex-start;
                gap: 12px;
                flex-direction: column
            }
        }
    </style>
</head>

<body>
    <div class="shell">

        <aside class="side">
            <div class="brand">
                Perpus<span>Kita.</span>
            </div>

            <div class="navlabel">MENU UTAMA</div>

            <nav class="nav">
                <a class="{{request()->routeIs('dashboard')?'active':''}}" href="{{route('dashboard')}}">
                    ▦ &nbsp; Dashboard
                </a>

                <a class="{{request()->routeIs('books.*')?'active':''}}" href="{{route('books.index')}}">
                    ▤ &nbsp; Data Buku
                </a>

                <a class="{{request()->routeIs('loans.*')?'active':''}}" href="{{route('loans.index')}}">
                    ⇄ &nbsp; Transaksi
                </a>

                @if(auth()->user()->role==='admin')
                    <a class="{{request()->routeIs('members.*')?'active':''}}" href="{{route('members.index')}}">
                        ♙ &nbsp; Kelola Anggota
                    </a>
                @endif
            </nav>

            <div class="navlabel" style="margin-top:25px">
                AKUN
            </div>

            <form method="POST" action="{{route('logout')}}">
                @csrf

                <button class="btn light" style="width:100%">
                    ↪ &nbsp; Keluar
                </button>
            </form>

            <div class="footer">
                Perpustakaan Sekolah Digital<br>
                Berjalan melalui localhost
            </div>
        </aside>

        <main class="main">
            <div class="top">
                <div>
                    <small>PERPUSTAKAAN SEKOLAH DIGITAL</small>

                    <div style="font-weight:700;margin-top:5px">
                        Halo, {{auth()->user()->name}} 👋
                    </div>
                </div>

                <span class="badge">
                    {{auth()->user()->role==='admin'?'Administrator':'Siswa'}}
                </span>
            </div>

            @if(session('success'))
                <div class="alert">
                    {{session('success')}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    {{session('error')}}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</body>

</html>

<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
    -->
<html>
<head>
    <title>Budget</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="/js/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="/css/app.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
    <noscript><link rel="stylesheet" href="/css/noscript.css" /></noscript>
</head>
<body class="is-loading">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main">
        <h1>Budget</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </p>
            </div>
        @endif

        <hr>
        <form action="{{ route('create') }}" method="post" class="well">
            {{ csrf_field() }}
            <div class="field">
                <input type="date" id="start-date" name="start-date" placeholder="Start Date" value="{{ old('start-date') }}">
            </div>
            <div class="field">
                <input type="date" id="end-date" name="end-date" placeholder="End Date" value="{{ old('end-date') }}">
            </div>
            <div class="field">
                <input type="number" id="value" name="cash" placeholder="Amount" value="{{ old('cash') }}">
            </div>
            <ul class="actions">
                <li>
                    <button type="submit" class="button">Create New Budget</button>
                </li>
            </ul>
        </form>

        <hr />

        <p>Create a budget and save to homescreen or bookmark the result. You will not be able to recover it otherwise.</p>

        <form action="{{ route('load') }}" class="well" style="display: none">
            {{ csrf_field() }}
            <div class="field">
                <input type="text" id="key" name="key" placeholder="Key">
            </div>
            <ul class="actions">
                <li>
                    <button type="submit" class="button">Load Existing Budget</button>
                </li>
            </ul>
        </form>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="copyright">
            <li>By <a href="http://michael.flanagan.ie/">micflan</a></li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </footer>

</div>

<!-- Scripts -->
<!--[if lte IE 8]><script src="/js/respond.min.js"></script><![endif]-->
<script>
    if ('addEventListener' in window) {
        window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
        document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
    }
</script>

</body>
</html>


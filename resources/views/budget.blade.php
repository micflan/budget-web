<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
    -->
<html>
<head>
    <title>Budget {{ $budget->getKey() }}</title>
    <meta charset="utf-8" />
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
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
        <header>
            <span class="remaining">
                &euro; {{ $budget->remainingBudget() }}</i>
            </span>
            <p>Remaining Today</p>
        </header>
        <hr />
        <!-- <h2>Extra Stuff!</h2> -->
        <form action="{{ route('spend', $budget->getKey()) }}" method="post" class="well">
            {{ csrf_field() }}
            <div class="field">
                <input type="number" name="value" id="value" placeholder="Spend something?" step="any">
            </div>
            <div class="field">
                <input type="hidden" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <!-- <div class="field">
                <textarea name="message" id="message" placeholder="Message" rows="4"></textarea>
            </div> -->
            <ul class="actions">
                <li><button type="submit" class="button">Spend</button></li>
            </ul>
        </form>
        <hr />
        <footer>
            <p class="todayIs">Day {{ $budget->totalDays() - $budget->remainingDays() + 1 }} of {{ $budget->totalDays() }}</p>
            <p class="spent">Spent Today: &euro; {{ $budget->spent() }}</p>
            <ul class="expenses">
                @foreach ($budget->expenses() as $expense)
                    <li>
                        <span class="value">&euro; {{ $expense->value() }}</span>
                        <span class="date">{{ $expense->date() }}</span>
                    </li>
                @endforeach
            </ul>
            <p>Total Savings: &euro; {{ $budget->savings() }}</p>
            <hr>
            <p>{{ $budget->startDate()->format('jS F') }} &mdash; {{ $budget->endDate()->format('jS F') }}</p>
            <p>Starting cash: &euro; {{ $budget->startingCash() }}</p>
            <p>Remaining cash: &euro; {{ $budget->remainingCash() }}</p>
        </footer>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="copyright">
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
    window.scrollTo(0,1);
</script>

</body>
</html>

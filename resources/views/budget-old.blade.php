<!DOCTYPE html>
<html>
    <head>
        <title>Budget</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1 class="title">Welcome.</h1>

                <div class="well">
                    <ul>
                        <li>Daily Budget: {{ $budget->dailyCash() }}</li>
                        <li style="font-size:larger;">Remaining: {{ $budget->remainingBudget() }}</li>
                        <li>Spent Today: {{ $budget->spent() }}</li>
                    </ul>
                </div>

                <form action="/budget/{{ $budget->getKey() }}/spend" method="post" class="well">
                    {{ csrf_field() }}
                    <h2>Spend</h2>
                    <div class="form-group">
                        <label class="control-label" for="value">How Much?</label>
                        <input type="text" name="value" id="value">
                        <input type="hidden" id="date" name="date" value="{{ date('Y-m-d') }}">
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                </form>

            </div>
        </div>
    </body>
</html>

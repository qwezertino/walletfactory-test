<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/test.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="test">
    <form id="form">
        EMAIL: <input type="text" name="email" id="email"><br/>
        DATE: <input type="text" name="date" id="date"><br/>
        TEXT: <input type="text" name="text" id="text"><br/>
        <button class="btn btn-success" id="submit">Submit</button>
    </form>
</div>
<div class="response"></div>
</body>
</html>


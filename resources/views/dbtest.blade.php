<!DOCTYPE html>
<html>
<head>
    <title>Database Connection Test</title>
</head>
<body>
    <h1>{{ $status }}</h1>
    
    @if (!empty($tables))
        <h3>Available Tables:</h3>
        <ul>
            @foreach ($tables as $table)
                <li>{{ is_object($table) ? reset($table) : $table }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>

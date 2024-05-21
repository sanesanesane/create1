<!DOCTYPE html>
<html>
<head>
    <title>Test Page</title>
</head>
<body>
    <h1>Test Page</h1>
    <a href="{{ route('dashboard.title') }}">Title View</a>
    <a href="{{ route('dashboard.menu') }}">Menu View</a>
    <p>Generated URL for dashboard.title: {{ route('dashboard.title') }}</p>
    <p>Generated URL for dashboard.menu: {{ route('dashboard.menu') }}</p>
</body>
</html>

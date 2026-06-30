<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyCalculator</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6fb; margin: 0; padding: 40px; }
        .card { max-width: 520px; margin: 0 auto; background: white; padding: 28px; border-radius: 16px; box-shadow: 0 12px 30px rgba(0,0,0,.08); }
        h1 { margin-top: 0; }
        label { display:block; margin-top: 14px; font-weight: 700; }
        input, select, button { width: 100%; padding: 12px; margin-top: 6px; border: 1px solid #ccd3e0; border-radius: 10px; font-size: 16px; box-sizing: border-box; }
        button { margin-top: 20px; background: #111827; color: white; cursor: pointer; }
        .result { margin-top: 20px; padding: 16px; background: #ecfdf5; border-radius: 10px; font-size: 20px; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 6px; }
        .links { margin-top: 18px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>MyCalculator</h1>
        <p>A simple Laravel calculator app for testing Docker, Multipass, and tenant provisioning.</p>

        <form method="POST" action="/calculate">
            @csrf

            <label for="a">First number</label>
            <input id="a" name="a" type="number" step="any" value="{{ old('a', $a) }}" required>
            @error('a') <div class="error">{{ $message }}</div> @enderror

            <label for="operation">Operation</label>
            <select id="operation" name="operation">
                <option value="add" @selected(old('operation', $operation) === 'add')>Add (+)</option>
                <option value="subtract" @selected(old('operation', $operation) === 'subtract')>Subtract (-)</option>
                <option value="multiply" @selected(old('operation', $operation) === 'multiply')>Multiply (×)</option>
                <option value="divide" @selected(old('operation', $operation) === 'divide')>Divide (÷)</option>
            </select>

            <label for="b">Second number</label>
            <input id="b" name="b" type="number" step="any" value="{{ old('b', $b) }}" required>
            @error('b') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Calculate</button>
        </form>

        @if(!is_null($result))
            <div class="result">
                Result: <strong>{{ $result }}</strong>
            </div>
        @endif

        <div class="links">
            Health check: <a href="/health">/health</a>
        </div>
    </div>
</body>
</html>

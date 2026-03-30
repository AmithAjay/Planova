<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Pending Approval – Planova</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem;
        }
        .card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            animation: fadeUp 0.6s ease;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            box-shadow: 0 0 30px rgba(245,158,11,0.4);
        }
        h1 {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        p {
            color: rgba(255,255,255,0.65);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .email-badge {
            display: inline-block;
            background: rgba(99,102,241,0.2);
            border: 1px solid rgba(99,102,241,0.4);
            color: #a5b4fc;
            border-radius: 8px;
            padding: 0.35rem 0.85rem;
            font-size: 0.88rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        .steps {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            text-align: left;
            margin-bottom: 1.75rem;
        }
        .step {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        .step:last-child { margin-bottom: 0; }
        .step-num {
            width: 22px; height: 22px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .alert-error {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.88rem;
            margin-bottom: 1.25rem;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 15px rgba(99,102,241,0.4);
        }
        .btn:hover { opacity: 0.9; transform: translateY(-1px); }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">⏳</div>
        <h1>Awaiting Approval</h1>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <p>Your admin account registration has been submitted and is currently under review by the Super Admin.</p>

        @if(session('pending_email'))
            <div class="email-badge">{{ session('pending_email') }}</div>
        @endif

        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <span>Your registration request has been received.</span>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <span>The Super Admin will review and approve your account.</span>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <span>Once approved, you can log in and access the admin dashboard.</span>
            </div>
        </div>

        <p>You will receive a notification once your account status is updated.</p>

        <a href="{{ route('login') }}" class="btn">Back to Login</a>
    </div>
</body>
</html>

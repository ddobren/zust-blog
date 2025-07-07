<?php
SessionManager::start();
$errors = ErrorHandlerSys::get();
ErrorHandlerSys::clear();
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin prijava | Žene u svijetu tehnologije</title>
    <link rel="stylesheet" href="../../public/css/globals.css" />
    <link rel="stylesheet" href="../../public/css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@400;600&family=Lexend:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="../../public/js/login.js" defer></script>
</head>

<body>
    <div class="login-page">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h1>Admin prijava</h1>
                </div>

                <form class="login-form" action="/cms/login" method="post">

                    <?php foreach ($errors as $error): ?>
                        <div class="login-error">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input type="text" id="username" name="username" autocomplete="username" required>
                    </div>

                    <div class="form-group">
                        <div class="label-wrapper">
                            <label for="password">Lozinka</label>
                        </div>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Unesite lozinku">
                            <button type="button" class="toggle-password" aria-label="Prikaži/sakrij lozinku">
                                <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="login-button" name="loginBtn">Prijavi se</button>
                </form>

                <div class="login-footer">
                    <a href="/" class="back-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Povratak na početnu
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

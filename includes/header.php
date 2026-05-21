<?php
/**
 * Header commun - Design futuriste 2advanced
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/../config.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?>Plateforme Éthique Mistral</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Futuristic -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #bc13fe;
            --neon-green: #0aff0a;
            --neon-red: #ff003c;
            --dark-bg: #0a0a0f;
            --dark-surface: #12121a;
            --dark-surface-2: #1a1a25;
            --text-primary: #ffffff;
            --text-secondary: #a0a0b0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(ellipse at 20% 80%, rgba(188, 19, 254, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(0, 243, 255, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(10, 10, 15, 1) 0%, transparent 100%);
        }
        
        .bg-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: 
                linear-gradient(rgba(0, 243, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }
        
        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        /* Navigation */
        .navbar-futuristic {
            background: rgba(18, 18, 26, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 243, 255, 0.2);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.1);
            padding: 1rem 2rem;
        }
        
        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 243, 255, 0.5);
        }
        
        .nav-link {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary) !important;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 0.5rem;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--neon-blue) !important;
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.8);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--neon-blue);
            transition: width 0.3s ease;
            box-shadow: 0 0 10px var(--neon-blue);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        /* Cards */
        .card-futuristic {
            background: rgba(26, 26, 37, 0.8);
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .card-futuristic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 243, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .card-futuristic:hover::before {
            left: 100%;
        }
        
        .card-futuristic:hover {
            border-color: var(--neon-blue);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.2);
            transform: translateY(-5px);
        }
        
        .card-header-futuristic {
            background: rgba(0, 243, 255, 0.1);
            border-bottom: 1px solid rgba(0, 243, 255, 0.2);
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        /* Buttons */
        .btn-futuristic {
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border: 2px solid var(--neon-blue);
            background: transparent;
            color: var(--neon-blue);
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-futuristic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--neon-blue);
            transition: left 0.3s ease;
            z-index: -1;
        }
        
        .btn-futuristic:hover {
            color: var(--dark-bg);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.6);
        }
        
        .btn-futuristic:hover::before {
            left: 0;
        }
        
        .btn-futuristic-primary {
            border-color: var(--neon-purple);
            color: var(--neon-purple);
        }
        
        .btn-futuristic-primary::before {
            background: var(--neon-purple);
        }
        
        .btn-futuristic-primary:hover {
            box-shadow: 0 0 30px rgba(188, 19, 254, 0.6);
        }
        
        .btn-futuristic-danger {
            border-color: var(--neon-red);
            color: var(--neon-red);
        }
        
        .btn-futuristic-danger::before {
            background: var(--neon-red);
        }
        
        .btn-futuristic-danger:hover {
            box-shadow: 0 0 30px rgba(255, 0, 60, 0.6);
        }
        
        /* Forms */
        .form-control-futuristic {
            background: rgba(10, 10, 15, 0.8);
            border: 1px solid rgba(0, 243, 255, 0.3);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control-futuristic:focus {
            background: rgba(10, 10, 15, 0.95);
            border-color: var(--neon-blue);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.3);
            color: var(--text-primary);
        }
        
        .form-control-futuristic::placeholder {
            color: var(--text-secondary);
        }
        
        /* Stats Indicators */
        .stat-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
        }
        
        .stat-indicator-critical {
            background: rgba(255, 0, 60, 0.2);
            border: 1px solid var(--neon-red);
            color: var(--neon-red);
        }
        
        .stat-indicator-warning {
            background: rgba(255, 165, 0, 0.2);
            border: 1px solid orange;
            color: orange;
        }
        
        .stat-indicator-safe {
            background: rgba(10, 255, 10, 0.2);
            border: 1px solid var(--neon-green);
            color: var(--neon-green);
        }
        
        /* Loading Spinner */
        .spinner-futuristic {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(0, 243, 255, 0.2);
            border-top-color: var(--neon-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Alert Boxes */
        .alert-futuristic {
            background: rgba(26, 26, 37, 0.9);
            border: 1px solid;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        
        .alert-info-futuristic {
            border-color: var(--neon-blue);
            color: var(--neon-blue);
        }
        
        .alert-success-futuristic {
            border-color: var(--neon-green);
            color: var(--neon-green);
        }
        
        .alert-warning-futuristic {
            border-color: orange;
            color: orange;
        }
        
        .alert-danger-futuristic {
            border-color: var(--neon-red);
            color: var(--neon-red);
        }
        
        /* Footer */
        .footer-futuristic {
            background: rgba(18, 18, 26, 0.95);
            border-top: 1px solid rgba(0, 243, 255, 0.2);
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        /* Progress Bars */
        .progress-futuristic {
            background: rgba(10, 10, 15, 0.8);
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 10px;
            height: 20px;
            overflow: hidden;
        }
        
        .progress-bar-futuristic {
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.5);
            transition: width 0.5s ease;
        }
        
        /* Glowing Text */
        .glow-text-blue {
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.8), 0 0 20px rgba(0, 243, 255, 0.5);
        }
        
        .glow-text-purple {
            text-shadow: 0 0 10px rgba(188, 19, 254, 0.8), 0 0 20px rgba(188, 19, 254, 0.5);
        }
        
        .glow-text-red {
            text-shadow: 0 0 10px rgba(255, 0, 60, 0.8), 0 0 20px rgba(255, 0, 60, 0.5);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-futuristic {
                padding: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
    
    <?php if (isset($additionalCSS)): ?>
        <?= $additionalCSS ?>
    <?php endif; ?>
</head>
<body>
    <!-- Background Effects -->
    <div class="bg-animation"></div>
    <div class="bg-grid"></div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-futuristic sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shield-halved me-2"></i>
                ETHICAL<span style="color: var(--neon-blue)">MISTRAL</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--neon-blue)">
                <span style="color: var(--neon-blue)"><i class="fas fa-bars"></i></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'index' ? 'active' : '' ?>" href="index.php">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'portal_auditor' ? 'active' : '' ?>" href="portal_auditor.php">
                            <i class="fas fa-balance-scale me-1"></i> Auditeur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'portal_jurist' ? 'active' : '' ?>" href="portal_jurist.php">
                            <i class="fas fa-gavel me-1"></i> Juriste
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'portal_survival' ? 'active' : '' ?>" href="portal_survival.php">
                            <i class="fas fa-heartbeat me-1"></i> Survie
                        </a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'settings' ? 'active' : '' ?>" href="settings.php">
                                <i class="fas fa-cog me-1"></i> Paramètres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'login' ? 'active' : '' ?>" href="login.php">
                                <i class="fas fa-sign-in-alt me-1"></i> Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="container py-4">

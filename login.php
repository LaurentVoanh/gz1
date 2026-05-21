<?php
/**
 * Page de connexion utilisateur
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';

$pageTitle = 'Connexion';
$currentPage = 'login';

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Authentification simplifiée (sans base de données)
        // Pour production, utiliser une vraie base de données avec mots de passe hashés
        
        // Hash simple pour démonstration (en prod: password_verify avec bcrypt)
        $storedHash = hash('sha256', 'admin123'); // Mot de passe par défaut: admin123
        $inputHash = hash('sha256', $password);
        
        // Accepter plusieurs emails de test
        $validEmails = ['admin@ethical.ai', 'user@ethical.ai', 'demo@ethical.ai'];
        
        if (in_array(strtolower($email), $validEmails) && $inputHash === $storedHash) {
            // Connexion réussie
            $_SESSION['user_id'] = uniqid('user_');
            $_SESSION['user_email'] = $email;
            $_SESSION['login_time'] = time();
            
            header('Location: index.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect';
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card-futuristic">
            <div class="card-header-futuristic text-center">
                <i class="fas fa-user-lock me-2"></i>CONNEXION
            </div>
            <div class="card-body p-4">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger-futuristic mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isLoggedIn()): ?>
                    <div class="alert alert-success-futuristic mb-4">
                        <i class="fas fa-check-circle me-2"></i>Vous êtes déjà connecté
                    </div>
                    <div class="text-center mt-4">
                        <a href="index.php" class="btn btn-futuristic">
                            <i class="fas fa-chart-line me-2"></i>Accéder au Dashboard
                        </a>
                    </div>
                <?php else: ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: var(--text-secondary);">
                                <i class="fas fa-envelope me-2"></i>Adresse Email
                            </label>
                            <input type="email" 
                                   class="form-control form-control-futuristic" 
                                   id="email" 
                                   name="email" 
                                   placeholder="admin@ethical.ai"
                                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                   required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color: var(--text-secondary);">
                                <i class="fas fa-key me-2"></i>Mot de Passe
                            </label>
                            <input type="password" 
                                   class="form-control form-control-futuristic" 
                                   id="password" 
                                   name="password" 
                                   placeholder="••••••••"
                                   required>
                            <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                                <i class="fas fa-info-circle me-1"></i>Démo: admin@ethical.ai / admin123
                            </small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-futuristic">
                                <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                            </button>
                        </div>
                    </form>
                    
                    <hr style="border-color: rgba(0, 243, 255, 0.2); margin: 2rem 0;">
                    
                    <div class="text-center">
                        <p style="color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-shield-halved me-1"></i>
                            Connexion sécurisée avec protocole éthique
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Informations API -->
        <div class="card-futuristic mt-4">
            <div class="card-body p-4">
                <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); margin-bottom: 1rem;">
                    <i class="fas fa-key me-2"></i>Configuration API Mistral
                </h6>
                <p style="color: var(--text-secondary); font-size: 0.9rem;">
                    Après connexion, accédez aux paramètres pour configurer vos clés API Mistral Free Tier.
                </p>
                <a href="signup_info.php" class="btn btn-futuristic-primary btn-sm" style="margin-top: 0.5rem;">
                    <i class="fas fa-question-circle me-1"></i>Comment obtenir une API Key?
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

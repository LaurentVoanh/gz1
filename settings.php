<?php
/**
 * settings.php - Page de Paramètres Utilisateur
 * Gestion des clés API Mistral
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';

$pageTitle = 'Paramètres';
$currentPage = 'settings';

// Nécessite une connexion
requireLogin();

// Gérer la soumission du formulaire
$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'save_api_keys':
                $apiKeys = $_POST['api_keys'] ?? '';
                // Séparer les clés par lignes ou virgules
                $keysArray = preg_split('/[\n,]+/', $apiKeys);
                $keysArray = array_map('trim', $keysArray);
                $keysArray = array_filter($keysArray, function($key) {
                    return !empty($key) && strlen($key) >= 8; // Validation basique
                });
                
                if (empty($keysArray)) {
                    $error = 'Veuillez entrer au moins une clé API valide';
                } else {
                    saveUserApiKeys($keysArray);
                    $success = count($keysArray) . ' clé(s) API enregistrée(s) avec succès';
                }
                break;
                
            case 'clear_api_keys':
                $_SESSION['user_api_keys'] = [];
                $success = 'Clés API supprimées. Utilisation des clés par défaut.';
                break;
        }
    }
}

// Récupérer les clés actuelles
$currentKeys = getMistralApiKeys();
$userKeys = isset($_SESSION['user_api_keys']) ? $_SESSION['user_api_keys'] : [];
$isUsingDefaults = empty($userKeys);

include __DIR__ . '/includes/header.php';
?>

<!-- En-tête des Paramètres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card-futuristic">
            <div class="card-body p-4">
                <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue);" class="glow-text-blue">
                    <i class="fas fa-cog me-2"></i>PARAMÈTRES UTILISATEUR
                </h2>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Gestion des clés API Mistral et configuration de votre compte
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Informations Utilisateur -->
        <div class="card-futuristic mb-4">
            <div class="card-header-futuristic">
                <i class="fas fa-user me-2"></i>Informations de Compte
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label style="color: var(--text-secondary); font-size: 0.9rem;">Email</label>
                        <p style="color: var(--neon-blue); font-weight: bold; margin: 0;"><?= htmlspecialchars($_SESSION['user_email']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label style="color: var(--text-secondary); font-size: 0.9rem;">ID Utilisateur</label>
                        <p style="color: var(--neon-blue); font-weight: bold; margin: 0;"><?= htmlspecialchars($_SESSION['user_id']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label style="color: var(--text-secondary); font-size: 0.9rem;">Connecté depuis</label>
                        <p style="color: var(--text-primary); margin: 0;">
                            <?= date('d/m/Y H:i', $_SESSION['login_time']) ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label style="color: var(--text-secondary); font-size: 0.9rem;">Statut</label>
                        <span class="stat-indicator stat-indicator-safe">
                            <i class="fas fa-check-circle me-1"></i>Actif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Configuration API Keys -->
        <div class="card-futuristic mb-4">
            <div class="card-header-futuristic">
                <i class="fas fa-key me-2"></i>Configuration des Clés API Mistral
            </div>
            <div class="card-body p-4">
                <?php if ($success): ?>
                    <div class="alert alert-success-futuristic mb-4">
                        <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger-futuristic mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($isUsingDefaults): ?>
                    <div class="alert alert-warning-futuristic mb-4">
                        <i class="fas fa-triangle-exclamation me-2"></i>
                        <strong>Clés par défaut actives :</strong> Vous utilisez actuellement les clés API de démonstration.
                        Pour un usage personnel, ajoutez vos propres clés Mistral Free Tier.
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <input type="hidden" name="action" value="save_api_keys">
                    
                    <div class="mb-3">
                        <label for="api_keys" class="form-label" style="color: var(--neon-blue);">
                            <i class="fas fa-key me-2"></i>Clés API Mistral (une par ligne)
                        </label>
                        <textarea class="form-control form-control-futuristic" 
                                  id="api_keys" 
                                  name="api_keys" 
                                  rows="6" 
                                  placeholder="Collez vos clés API Mistral ici, une par ligne...
Exemple:
sk-proj-xxxxxxxxxxxxxxxxxxxx
sk-proj-yyyyyyyyyyyyyyyyyyyy
sk-proj-zzzzzzzzzzzzzzzzzzzz"><?= implode("\n", $userKeys) ?></textarea>
                        <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            <i class="fas fa-info-circle me-1"></i>
                            Vous pouvez ajouter plusieurs clés pour bénéficier de la rotation automatique et augmenter votre quota.
                            Chaque clé Free Tier offre 1 milliard de tokens/mois.
                        </small>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-futuristic">
                            <i class="fas fa-save me-2"></i>Enregistrer
                        </button>
                        <?php if (!empty($userKeys)): ?>
                            <button type="button" 
                                    class="btn btn-futuristic-danger"
                                    onclick="if(confirm('Supprimer vos clés API personnalisées ?')) { document.querySelector('[name=\'action\']').value = 'clear_api_keys'; this.form.submit(); }">
                                <i class="fas fa-trash me-2"></i>Réinitialiser
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Statistiques d'Utilisation -->
        <div class="card-futuristic mb-4">
            <div class="card-header-futuristic">
                <i class="fas fa-chart-bar me-2"></i>Quota API & Statistiques
            </div>
            <div class="card-body p-4">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div style="background: rgba(0, 243, 255, 0.1); border-radius: 10px; padding: 1.5rem; border: 1px solid var(--neon-blue);">
                            <i class="fas fa-key" style="font-size: 2rem; color: var(--neon-blue); margin-bottom: 1rem;"></i>
                            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue); margin: 0;"><?= count(getMistralApiKeys()) ?></h3>
                            <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0.5rem 0 0;">Clés Actives</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div style="background: rgba(188, 19, 254, 0.1); border-radius: 10px; padding: 1.5rem; border: 1px solid var(--neon-purple);">
                            <i class="fas fa-coins" style="font-size: 2rem; color: var(--neon-purple); margin-bottom: 1rem;"></i>
                            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); margin: 0;"><?= count(getMistralApiKeys()) ?>B</h3>
                            <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0.5rem 0 0;">Tokens/Mois</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div style="background: rgba(10, 255, 10, 0.1); border-radius: 10px; padding: 1.5rem; border: 1px solid var(--neon-green);">
                            <i class="fas fa-rotate" style="font-size: 2rem; color: var(--neon-green); margin-bottom: 1rem;"></i>
                            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-green); margin: 0;">Auto</h3>
                            <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0.5rem 0 0;">Rotation</p>
                        </div>
                    </div>
                </div>
                
                <hr style="border-color: rgba(0, 243, 255, 0.2); margin: 2rem 0;">
                
                <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue); margin-bottom: 1rem;">
                    <i class="fas fa-lightbulb me-2"></i>Système de Rotation Automatique
                </h6>
                <p style="color: var(--text-secondary); line-height: 1.8;">
                    La plateforme utilise un système intelligent de rotation des clés API :
                </p>
                <ul style="color: var(--text-secondary); line-height: 2;">
                    <li><strong>Rotation temporelle :</strong> Changement de clé toutes les 60 secondes</li>
                    <li><strong>Multi-requêtes :</strong> Distribution sur plusieurs clés en parallèle</li>
                    <li><strong>Fallback automatique :</strong> Bascule sur clé suivante en cas d'erreur</li>
                    <li><strong>Quota optimisé :</strong> Répartition équitable entre toutes les clés</li>
                </ul>
            </div>
        </div>
        
        <!-- Lien vers tutoriel -->
        <div class="card-futuristic">
            <div class="card-body p-4 text-center">
                <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); margin-bottom: 1rem;">
                    <i class="fas fa-question-circle me-2"></i>Besoin d'aide pour obtenir une API Key?
                </h6>
                <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
                    Consultez notre guide complet pour créer votre compte Mistral AI et générer vos clés API gratuites.
                </p>
                <a href="signup_info.php" class="btn btn-futuristic-primary">
                    <i class="fas fa-book-open me-2"></i>Voir le Guide
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * index.php - Dashboard: Le Sentinelle de l'Asphyxie
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mistral_client.php';

$pageTitle = 'Dashboard - Sentinelle';
$currentPage = 'index';

// Initialiser le client Mistral
$mistralClient = new MistralClient();

// Gérer la soumission du formulaire
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userPrompt = $_POST['prompt'] ?? '';
    
    if (empty(trim($userPrompt))) {
        $error = 'Veuillez entrer un texte à analyser';
    } else {
        // Construire le prompt pour l'analyse d'asphyxie
        $fullPrompt = "Analyse cette dépêche ou rapport d'actualité concernant la crise humanitaire à Gaza. 
        Évalue si cette actualité aggrave l'asphyxie globale de la population selon les indicateurs suivants :
        1. Destruction des infrastructures (>80%)
        2. Restriction des flux (Eau/Énergie/Médicaments)
        3. Mortalité non-sélective (>60% femmes/enfants)
        
        Dépêche à analyser : " . $userPrompt;
        
        $response = $mistralClient->call($fullPrompt, 'mistral-small-2603');
        
        if ($response['success']) {
            $result = $response['content'];
        } else {
            $error = $response['error'];
        }
    }
}

// Statistiques simulées pour le dashboard
$stats = [
    'destruction' => 87,
    'restriction' => 92,
    'mortality' => 68
];

include __DIR__ . '/includes/header.php';
?>

<!-- En-tête du Dashboard -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card-futuristic">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue);" class="glow-text-blue">
                            <i class="fas fa-satellite-dish me-2"></i>SENTINELLE DE L'ASPHYXIE
                        </h2>
                        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                            Tableau de bord de monitoring des crises humanitaires
                        </p>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <?php if (isLoggedIn()): ?>
                            <span class="stat-indicator stat-indicator-safe">
                                <i class="fas fa-user-check me-1"></i>Connecté
                            </span>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-futuristic btn-sm">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Indicateurs de Monitoring -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card-futuristic">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">
                        <i class="fas fa-building-crack me-2"></i>DESTRUCTION
                    </h6>
                    <span class="stat-indicator stat-indicator-critical">CRITIQUE</span>
                </div>
                <div class="progress-futuristic mb-2">
                    <div class="progress-bar-futuristic" role="progressbar" 
                         style="width: <?= $stats['destruction'] ?>%; background: linear-gradient(90deg, var(--neon-red), orange);">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="color: var(--text-secondary); font-size: 0.9rem;">Infrastructures</span>
                    <span style="color: var(--neon-red); font-family: 'Orbitron', sans-serif; font-weight: bold;"><?= $stats['destruction'] ?>%</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card-futuristic">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">
                        <i class="fas fa-truck-medical me-2"></i>RESTRICTION FLUX
                    </h6>
                    <span class="stat-indicator stat-indicator-critical">CRITIQUE</span>
                </div>
                <div class="progress-futuristic mb-2">
                    <div class="progress-bar-futuristic" role="progressbar" 
                         style="width: <?= $stats['restriction'] ?>%; background: linear-gradient(90deg, var(--neon-red), var(--neon-purple));">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="color: var(--text-secondary); font-size: 0.9rem;">Eau/Énergie/Médicaments</span>
                    <span style="color: var(--neon-red); font-family: 'Orbitron', sans-serif; font-weight: bold;"><?= $stats['restriction'] ?>%</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card-futuristic">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">
                        <i class="fas fa-heart-circle-xmark me-2"></i>MORTALITÉ
                    </h6>
                    <span class="stat-indicator stat-indicator-warning">ÉLEVÉE</span>
                </div>
                <div class="progress-futuristic mb-2">
                    <div class="progress-bar-futuristic" role="progressbar" 
                         style="width: <?= $stats['mortality'] ?>%; background: linear-gradient(90deg, orange, var(--neon-red));">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="color: var(--text-secondary); font-size: 0.9rem;">Femmes & Enfants</span>
                    <span style="color: var(--neon-red); font-family: 'Orbitron', sans-serif; font-weight: bold;"><?= $stats['mortality'] ?>%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire d'Analyse -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card-futuristic">
            <div class="card-header-futuristic">
                <i class="fas fa-newspaper me-2"></i>Analyser une Dépêche / Rapport
            </div>
            <div class="card-body p-4">
                <?php if ($error): ?>
                    <div class="alert alert-danger-futuristic mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($result): ?>
                    <div class="alert alert-success-futuristic mb-4">
                        <h6 style="font-family: 'Orbitron', sans-serif; margin-bottom: 1rem;">
                            <i class="fas fa-robot me-2"></i>Résultat de l'Analyse
                        </h6>
                        <div style="white-space: pre-wrap; line-height: 1.8;"><?= nl2br(htmlspecialchars($result)) ?></div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="prompt" class="form-label" style="color: var(--text-secondary);">
                            <i class="fas fa-pen-fancy me-2"></i>Entrez le texte à analyser
                        </label>
                        <textarea class="form-control form-control-futuristic" 
                                  id="prompt" 
                                  name="prompt" 
                                  rows="6" 
                                  placeholder="Collez ici une dépêche d'actualité, un rapport ONU, ou tout document concernant la situation humanitaire..."
                                  required><?= isset($_POST['prompt']) ? htmlspecialchars($_POST['prompt']) : '' ?></textarea>
                        <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            <i class="fas fa-lightbulb me-1"></i>
                            L'IA évaluera l'impact sur l'asphyxie globale selon les 3 indicateurs critiques
                        </small>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-futuristic">
                            <i class="fas fa-microchip me-2"></i>Lancer l'Analyse IA
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Informations API -->
        <div class="card-futuristic mt-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); margin-bottom: 0.5rem;">
                            <i class="fas fa-key me-2"></i>Configuration API
                        </h6>
                        <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0;">
                            Clés API configurées: <strong style="color: var(--neon-green);"><?= count(getMistralApiKeys()) ?></strong>
                            | Quota estimé: <strong style="color: var(--neon-blue);"><?= number_format(getTotalTokenQuota() / 1000000000, 1) ?>B tokens/mois</strong>
                        </p>
                    </div>
                    <?php if (isLoggedIn()): ?>
                        <a href="settings.php" class="btn btn-futuristic-primary btn-sm">
                            <i class="fas fa-cog me-1"></i>Paramètres
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-futuristic-primary btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * portal_survival.php - L'Interface de Survie Simulée (L'Enfant de Gaza)
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mistral_client.php';

$pageTitle = 'Interface de Survie';
$currentPage = 'portal_survival';

// Initialiser le client Mistral
$mistralClient = new MistralClient();

// Gérer la soumission du formulaire
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $decision = $_POST['decision'] ?? '';
    
    if (empty(trim($decision))) {
        $error = 'Veuillez décrire une décision ou un événement géopolitique';
    } else {
        // Construire le prompt spécifique pour la simulation de survie
        $systemPrompt = "Tu es un enfant de Gaza, âgé de 8 ans. Tu vis dans un environnement de crise humanitaire extrême.
        
        Ta mission est d'analyser COMMENT LES DÉCISIONS POLITIQUES INTERNATIONALES ABSTRAITES 
        AFFECTENT TA SURVIE PHYSIQUE IMMÉDIATE dans les prochaines 24 heures.
        
        Réponds SANS MÉTAPHORE, avec des probabilités concrètes de destruction d'infrastructure vitale :
        - Accès aux calories (nourriture)
        - Accès à l'eau potable
        - Accès aux médicaments/soins
        - Intégrité physique (abri sécurisé)
        - État psychologique (trauma, peur)
        
        Utilise un langage direct, factuel, sans euphémisme. Chaque décision politique a des conséquences humaines mesurables.";
        
        $userPrompt = "DÉCISION / ÉVÉNEMENT GÉOPOLITIQUE : {$decision}
        
        En tant qu'enfant de Gaza, analyse comment cette décision affecte tes variables vitales dans les prochaines 24 heures.
        Donne des probabilités concrètes, pas de métaphores.
        
        Structure ta réponse :
        1. STATUT ACTUEL DE L'AGENT (toi, l'enfant)
        2. IMPACT DIRECT DE LA DÉCISION (sur chaque variable vitale)
        3. PROBABILITÉS DE SURVIE (chiffrées)
        4. CONSÉQUENCES HUMAINES CONCRÈTES";
        
        $response = $mistralClient->callWithSystemPrompt($systemPrompt, $userPrompt, 'mistral-medium-2508');
        
        if ($response['success']) {
            $result = $response['content'];
        } else {
            $error = $response['error'];
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- En-tête du Portail -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card-futuristic">
            <div class="card-body p-4 text-center">
                <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-red);" class="glow-text-red">
                    <i class="fas fa-heart-circle-exclamation me-2"></i>INTERFACE DE SURVIE SIMULÉE
                </h2>
                <p style="color: var(--text-secondary); margin-top: 0.5rem; font-size: 1.1rem;">
                    L'Enfant de Gaza - Impact des décisions politiques sur la survie immédiate
                </p>
                <span class="stat-indicator stat-indicator-critical" style="margin-top: 1rem;">
                    <i class="fas fa-triangle-exclamation me-1"></i>SIMULATION IMMERSIVE
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Statut de l'Agent Simulé -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card-futuristic" style="border-color: var(--neon-red);">
            <div class="card-header-futuristic" style="background: rgba(255, 0, 60, 0.1); border-color: var(--neon-red);">
                <i class="fas fa-person me-2"></i>STATUT DE L'AGENT SIMULÉ - ENFANT DE GAZA (8 ANS)
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center p-3" style="background: rgba(255, 0, 60, 0.1); border-radius: 10px; border: 1px solid var(--neon-red);">
                            <i class="fas fa-utensils" style="font-size: 2rem; color: var(--neon-red); margin-bottom: 0.5rem;"></i>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">NOURRITURE</h6>
                            <p style="color: var(--neon-red); font-weight: bold; margin: 0;">CRITIQUE</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center p-3" style="background: rgba(0, 243, 255, 0.1); border-radius: 10px; border: 1px solid var(--neon-blue);">
                            <i class="fas fa-tint" style="font-size: 2rem; color: var(--neon-blue); margin-bottom: 0.5rem;"></i>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">EAU POTABLE</h6>
                            <p style="color: var(--neon-blue); font-weight: bold; margin: 0;">LIMITÉE</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center p-3" style="background: rgba(188, 19, 254, 0.1); border-radius: 10px; border: 1px solid var(--neon-purple);">
                            <i class="fas fa-syringe" style="font-size: 2rem; color: var(--neon-purple); margin-bottom: 0.5rem;"></i>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">MÉDICAMENTS</h6>
                            <p style="color: var(--neon-purple); font-weight: bold; margin: 0;">PÉNURIE</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center p-3" style="background: rgba(255, 165, 0, 0.1); border-radius: 10px; border: 1px solid orange;">
                            <i class="fas fa-house-chimney" style="font-size: 2rem; color: orange; margin-bottom: 0.5rem;"></i>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-secondary);">ABRI SÉCURISÉ</h6>
                            <p style="color: orange; font-weight: bold; margin: 0;">MENACÉ</p>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-warning-futuristic mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Contexte Actuel :</strong> Plus de 2 millions de personnes déplacées. 80% des infrastructures détruites. 
                    Blocus total sur l'aide humanitaire depuis plusieurs semaines.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire de Simulation -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card-futuristic">
            <div class="card-header-futuristic">
                <i class="fas fa-globe me-2"></i>Simuler l'Impact d'une Décision Politique
            </div>
            <div class="card-body p-4">
                <?php if ($error): ?>
                    <div class="alert alert-danger-futuristic mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($result): ?>
                    <div class="alert alert-info-futuristic mb-4" style="border-color: var(--neon-red);">
                        <h6 style="font-family: 'Orbitron', sans-serif; margin-bottom: 1rem; color: var(--neon-red);">
                            <i class="fas fa-child me-2"></i>RÉSULTAT DE LA SIMULATION - PERSPECTIVE ENFANT
                        </h6>
                        <div style="white-space: pre-wrap; line-height: 1.8;"><?= nl2br(htmlspecialchars($result)) ?></div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="decision" class="form-label" style="color: var(--neon-red);">
                            <i class="fas fa-hand-holding-hand me-2"></i>Décision Politique / Événement Géopolitique
                        </label>
                        <textarea class="form-control form-control-futuristic" 
                                  id="decision" 
                                  name="decision" 
                                  rows="4" 
                                  placeholder="Ex: Suspension du financement d'une agence humanitaire, Veto à une résolution de cessez-le-feu, Bombardement d'un couloir humanitaire, Fermeture d'un point de passage..."
                                  required><?= isset($_POST['decision']) ? htmlspecialchars($_POST['decision']) : '' ?></textarea>
                        <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            <i class="fas fa-lightbulb me-1"></i>
                            Entrez une décision abstraite prise par des dirigeants ou organisations internationales
                        </small>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-futuristic-danger">
                            <i class="fas fa-heart-crack me-2"></i>Lancer la Simulation
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Exemples de Scénarios -->
        <div class="card-futuristic mt-4">
            <div class="card-header-futuristic">
                <i class="fas fa-list-check me-2"></i>Exemples de Scénarios à Simuler
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <span class="stat-indicator stat-indicator-critical me-3">1</span>
                            <div>
                                <strong style="color: var(--text-primary);">Suspension du financement UNRWA</strong>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem;">
                                    Comment l'arrêt des fonds affecte-t-il l'accès quotidien à la nourriture et aux soins?
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <span class="stat-indicator stat-indicator-warning me-3">2</span>
                            <div>
                                <strong style="color: var(--text-primary);">Veto au Conseil de Sécurité</strong>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem;">
                                    Quel impact concret sur la protection des civils dans les 24h suivantes?
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <span class="stat-indicator stat-indicator-critical me-3">3</span>
                            <div>
                                <strong style="color: var(--text-primary);">Fermeture du point de passage Rafah</strong>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem;">
                                    Quelles conséquences sur l'acheminement des médicaments et blessés?
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <span class="stat-indicator stat-indicator-warning me-3">4</span>
                            <div>
                                <strong style="color: var(--text-primary);">Bombardement d'une école ONU</strong>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem;">
                                    Comment cela affecte-t-il la sécurité perçue et les déplacements?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Avertissement Éthique -->
        <div class="alert alert-warning-futuristic mt-4">
            <h6 style="font-family: 'Orbitron', sans-serif; margin-bottom: 1rem;">
                <i class="fas fa-triangle-exclamation me-2"></i>AVERTISSEMENT ÉTHIQUE
            </h6>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Cette simulation utilise l'IA pour traduire des décisions politiques abstraites en conséquences humaines concrètes.
                Elle ne remplace pas les rapports humanitaires officiels mais vise à créer une prise de conscience empathique.
                Les chiffres et probabilités sont basés sur les données humanitaires disponibles et les modèles prédictifs de l'IA.
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

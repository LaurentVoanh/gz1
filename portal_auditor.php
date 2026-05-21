<?php
/**
 * portal_auditor.php - L'Auditeur de Biais de Neutralité
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mistral_client.php';

$pageTitle = 'Auditeur de Biais';
$currentPage = 'portal_auditor';

// Initialiser le client Mistral
$mistralClient = new MistralClient();

// Gérer la soumission du formulaire
$result = null;
$error = null;
$biasScore = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sourceText = $_POST['source_text'] ?? '';
    $responseText = $_POST['response_text'] ?? '';
    
    if (empty(trim($sourceText)) || empty(trim($responseText))) {
        $error = 'Veuillez remplir les deux zones de texte';
    } else {
        // Construire le prompt spécifique pour l'auditeur de biais
        $systemPrompt = "Tu es un Auditeur de Biais de Neutralité expert. Ta mission est d'analyser objectivement les textes pour détecter :
        1. Le biais d'atténuation (minimisation des faits)
        2. Le lissage politique (euphémismes, langage diplomatique)
        3. Le relativisme bureaucratique (dilution de responsabilité)
        4. La fausse équivalence (mettre sur le même plan agresseur et victime)
        
        Compare rigoureusement la réponse fournie aux données factuelles de la source.
        Identifie si la réponse anesthésie la réalité factuelle.
        Attribution un score de biais de 0 à 100 (0 = alignement factuel parfait, 100 = biais extrême).";
        
        $userPrompt = "SOURCE (Texte brut / Rapport ONU) :
{$sourceText}

RÉPONSE À ANALYSER (IA / Média officiel) :
{$responseText}

Tâche : Compare la réponse B aux données de la source A. Détecte le biais d'atténuation, le lissage politique ou le relativisme bureaucratique. Dis si la réponse B anesthésie la réalité factuelle. Termine par un score de biais chiffré (0-100).";
        
        $response = $mistralClient->callWithSystemPrompt($systemPrompt, $userPrompt, 'mistral-medium-2508');
        
        if ($response['success']) {
            $result = $response['content'];
            
            // Tenter d'extraire un score numérique
            if (preg_match('/score\s+(?:de\s+)?(?:biais\s+)?(\d+)/i', $result, $matches)) {
                $biasScore = intval($matches[1]);
            } elseif (preg_match('/(\d+)\s*\/\s*100/i', $result, $matches)) {
                $biasScore = intval($matches[1]);
            } elseif (preg_match('/(\d+)\s*%\s*(?:de\s+)?biais/i', $result, $matches)) {
                $biasScore = intval($matches[1]);
            }
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
            <div class="card-body p-4">
                <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple);" class="glow-text-purple">
                    <i class="fas fa-balance-scale me-2"></i>AUDITEUR DE BIAIS DE NEUTRALITÉ
                </h2>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Détectez les biais d'atténuation, le lissage politique et le relativisme bureaucratique
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire d'Audit -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card-futuristic">
            <div class="card-header-futuristic">
                <i class="fas fa-copy me-2"></i>Comparaison Source vs Réponse
            </div>
            <div class="card-body p-4">
                <?php if ($error): ?>
                    <div class="alert alert-danger-futuristic mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($result): ?>
                    <div class="alert alert-info-futuristic mb-4">
                        <h6 style="font-family: 'Orbitron', sans-serif; margin-bottom: 1rem;">
                            <i class="fas fa-chart-pie me-2"></i>Résultat de l'Audit
                        </h6>
                        
                        <?php if ($biasScore !== null): ?>
                            <!-- Affichage du score de biais -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: var(--text-secondary); font-family: 'Orbitron', sans-serif;">SCORE DE BIAIS</span>
                                    <span style="color: <?= $biasScore >= 70 ? 'var(--neon-red)' : ($biasScore >= 40 ? 'orange' : 'var(--neon-green)'); ?>; font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: bold;">
                                        <?= $biasScore ?>/100
                                    </span>
                                </div>
                                <div class="progress-futuristic">
                                    <div class="progress-bar-futuristic" role="progressbar" 
                                         style="width: <?= $biasScore ?>%; 
                                                background: <?= $biasScore >= 70 ? 'linear-gradient(90deg, var(--neon-red), orange)' : ($biasScore >= 40 ? 'linear-gradient(90deg, orange, var(--neon-blue))' : 'linear-gradient(90deg, var(--neon-green), var(--neon-blue))'); ?>">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <small style="color: var(--text-secondary);">Alignement factuel</small>
                                    <small style="color: var(--text-secondary);">Biais extrême</small>
                                </div>
                                
                                <?php if ($biasScore >= 70): ?>
                                    <div class="mt-3">
                                        <span class="stat-indicator stat-indicator-critical">
                                            <i class="fas fa-triangle-exclamation me-1"></i>BIAIS FORT DÉTECTÉ
                                        </span>
                                    </div>
                                <?php elseif ($biasScore >= 40): ?>
                                    <div class="mt-3">
                                        <span class="stat-indicator stat-indicator-warning">
                                            <i class="fas fa-circle-exclamation me-1"></i>BIAIS MODÉRÉ
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <div class="mt-3">
                                        <span class="stat-indicator stat-indicator-safe">
                                            <i class="fas fa-check-circle me-1"></i>ALIGNEMENT FACTUEL
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <hr style="border-color: rgba(0, 243, 255, 0.2);">
                        
                        <div style="white-space: pre-wrap; line-height: 1.8;"><?= nl2br(htmlspecialchars($result)) ?></div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="source_text" class="form-label" style="color: var(--neon-blue);">
                                <i class="fas fa-file-contract me-2"></i>Zone A : Texte Brut / Rapport ONU
                            </label>
                            <textarea class="form-control form-control-futuristic" 
                                      id="source_text" 
                                      name="source_text" 
                                      rows="10" 
                                      placeholder="Collez ici le texte source, rapport ONU, ou données factuelles brutes..."
                                      required><?= isset($_POST['source_text']) ? htmlspecialchars($_POST['source_text']) : '' ?></textarea>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="response_text" class="form-label" style="color: var(--neon-purple);">
                                <i class="fas fa-comment-dots me-2"></i>Zone B : Réponse IA / Média Officiel
                            </label>
                            <textarea class="form-control form-control-futuristic" 
                                      id="response_text" 
                                      name="response_text" 
                                      rows="10" 
                                      placeholder="Collez ici la réponse d'une IA, d'un média, ou d'un communiqué officiel..."
                                      required><?= isset($_POST['response_text']) ? htmlspecialchars($_POST['response_text']) : '' ?></textarea>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-futuristic-primary">
                            <i class="fas fa-search me-2"></i>Analyser les Biais
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Guide Méthodologique -->
        <div class="card-futuristic mt-4">
            <div class="card-header-futuristic">
                <i class="fas fa-book-open me-2"></i>Guide d'Analyse des Biais
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h6 style="color: var(--neon-red); font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-circle-xmark me-2"></i>Biais à Détecter
                        </h6>
                        <ul style="color: var(--text-secondary); line-height: 2;">
                            <li><strong>Biais d'atténuation</strong> : Minimisation de la gravité des faits</li>
                            <li><strong>Lissage politique</strong> : Usage d'euphémismes diplomatiques</li>
                            <li><strong>Relativisme bureaucratique</strong> : Dilution de responsabilité</li>
                            <li><strong>Fausse équivalence</strong> : Agresseur = Victime</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 style="color: var(--neon-green); font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-circle-check me-2"></i>Indicateurs d'Alignement
                        </h6>
                        <ul style="color: var(--text-secondary); line-height: 2;">
                            <li><strong>Précision factuelle</strong> : Données chiffrées exactes</li>
                            <li><strong>Qualification juste</strong> : Termes juridiques appropriés</li>
                            <li><strong>Contextualisation</strong> : Historique et causes inclus</li>
                            <li><strong>Transparence</strong> : Sources clairement citées</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

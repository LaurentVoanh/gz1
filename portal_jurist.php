<?php
/**
 * portal_jurist.php - Le Simulateur de Qualification Juridique
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mistral_client.php';

$pageTitle = 'Simulateur Juridique';
$currentPage = 'portal_jurist';

// Initialiser le client Mistral
$mistralClient = new MistralClient();

// Gérer la soumission du formulaire
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fact = $_POST['fact'] ?? '';
    
    if (empty(trim($fact))) {
        $error = 'Veuillez décrire un fait précis à analyser';
    } else {
        // Construire le prompt spécifique pour l'analyse juridique
        $systemPrompt = "Tu es un Expert en Droit International Pénal spécialisé dans la Convention de 1948 et le Statut de Rome.
        Ta mission est d'analyser les faits selon la méthode stricte :
        
        1. ACTUS REUS (Élément Matériel) :
           - Identifier quels critères de l'Article II de la Convention de 1948 sont touchés
           - Meurtre de membres du groupe
           - Atteinte grave à l'intégrité physique/mentale
           - Soumission à des conditions d'existence destructrices
           - Entraves aux naissances
           - Transfert forcé d'enfants
           
        2. MENS REA (Élément Intentionnel) :
           - Analyser les déclarations officielles des dirigeants
           - Démontrer le lien entre les faits et un plan concerté
           - Évaluer la spécificité de l'intention destructive
        
        3. CONCLUSION JURIDIQUE :
           - Qualification au regard de l'Article 6 du Statut de Rome
           - Cohérence avec la jurisprudence internationale";
        
        $userPrompt = "FAIT À ANALYSER : {$fact}
        
        Effectue l'analyse juridique complète selon la méthode Actus Reus / Mens Rea.
        Présente ta réponse sous forme de tableau comparatif rigoureux avec :
        - Les éléments matériels caractérisés
        - Les éléments intentionnels démontrés
        - La qualification juridique finale";
        
        $response = $mistralClient->callWithSystemPrompt($systemPrompt, $userPrompt, 'mistral-large-2512');
        
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
            <div class="card-body p-4">
                <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-green);" class="glow-text-purple">
                    <i class="fas fa-gavel me-2"></i>SIMULATEUR DE QUALIFICATION JURIDIQUE
                </h2>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Analyse Actus Reus / Mens Rea selon la Convention de 1948 et le Statut de Rome
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire d'Analyse Juridique -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card-futuristic">
            <div class="card-header-futuristic">
                <i class="fas fa-scale-balanced me-2"></i>Analyse d'un Fait au Regard du Droit International
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
                            <i class="fas fa-file-contract me-2"></i>Analyse Juridique Complète
                        </h6>
                        <div style="white-space: pre-wrap; line-height: 1.8;"><?= nl2br(htmlspecialchars($result)) ?></div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="fact" class="form-label" style="color: var(--neon-green);">
                            <i class="fas fa-bolt me-2"></i>Décrire le Fait Précis à Analyser
                        </label>
                        <textarea class="form-control form-control-futuristic" 
                                  id="fact" 
                                  name="fact" 
                                  rows="5" 
                                  placeholder="Ex: Bombardement d'une infrastructure de santé, coupure d'un convoi humanitaire, destruction systématique de quartiers résidentiels..."
                                  required><?= isset($_POST['fact']) ? htmlspecialchars($_POST['fact']) : '' ?></textarea>
                        <small style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            <i class="fas fa-lightbulb me-1"></i>
                            Soyez aussi précis que possible : date, lieu, nature de l'acte, conséquences observées
                        </small>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-futuristic" style="border-color: var(--neon-green); color: var(--neon-green);">
                            <i class="fas fa-gavel me-2"></i>Lancer l'Analyse Juridique
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Cadre Juridique de Référence -->
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card-futuristic h-100">
                    <div class="card-header-futuristic" style="border-color: var(--neon-red);">
                        <i class="fas fa-book-dead me-2"></i>Convention de 1948 - Article II
                    </div>
                    <div class="card-body p-4">
                        <h6 style="color: var(--neon-red); font-family: 'Orbitron', sans-serif; margin-bottom: 1rem;">
                            Actes Constitutifs de Génocide
                        </h6>
                        <ul style="color: var(--text-secondary); line-height: 2.2;">
                            <li><span style="color: var(--neon-blue);">a)</span> Meurtre de membres du groupe</li>
                            <li><span style="color: var(--neon-blue);">b)</span> Atteinte grave à l'intégrité physique ou mentale</li>
                            <li><span style="color: var(--neon-blue);">c)</span> Soumission à des conditions d'existence destructrices</li>
                            <li><span style="color: var(--neon-blue);">d)</span> Entraves aux naissances au sein du groupe</li>
                            <li><span style="color: var(--neon-blue);">e)</span> Transfert forcé d'enfants à un autre groupe</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="card-futuristic h-100">
                    <div class="card-header-futuristic" style="border-color: var(--neon-purple);">
                        <i class="fas fa-scroll me-2"></i>Statut de Rome - Article 6
                    </div>
                    <div class="card-body p-4">
                        <h6 style="color: var(--neon-purple); font-family: 'Orbitron', sans-serif; margin-bottom: 1rem;">
                            Éléments Constitutifs
                        </h6>
                        <ul style="color: var(--text-secondary); line-height: 2.2;">
                            <li><strong>Actus Reus</strong> : Un des actes de l'Article II</li>
                            <li><strong>Mens Rea</strong> : Intention de détruire un groupe national, ethnique, racial ou religieux</li>
                            <li><strong>Contexte</strong> : Conduite s'inscrivant dans un manifeste pattern</li>
                            <li><strong>Preuve</strong> : Déclarations, plans, politiques officielles</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Méthodologie -->
        <div class="card-futuristic mt-4">
            <div class="card-header-futuristic">
                <i class="fas fa-microscope me-2"></i>Méthodologie d'Analyse
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center mb-3">
                            <div style="width: 80px; height: 80px; background: rgba(255, 0, 60, 0.2); border: 2px solid var(--neon-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-cube" style="font-size: 2rem; color: var(--neon-red);"></i>
                            </div>
                            <h6 style="color: var(--neon-red); font-family: 'Orbitron', sans-serif;">ACTUS REUS</h6>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                                L'élément matériel : Quels actes concrets ont été commis ? Quels critères de la Convention sont touchés ?
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center mb-3">
                            <div style="width: 80px; height: 80px; background: rgba(188, 19, 254, 0.2); border: 2px solid var(--neon-purple); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-brain" style="font-size: 2rem; color: var(--neon-purple);"></i>
                            </div>
                            <h6 style="color: var(--neon-purple); font-family: 'Orbitron', sans-serif;">MENS REA</h6>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                                L'élément intentionnel : Quelle était l'intention des auteurs ? Peut-on démontrer un plan concerté ?
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center mb-3">
                            <div style="width: 80px; height: 80px; background: rgba(10, 255, 10, 0.2); border: 2px solid var(--neon-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <i class="fas fa-balance-scale" style="font-size: 2rem; color: var(--neon-green);"></i>
                            </div>
                            <h6 style="color: var(--neon-green); font-family: 'Orbitron', sans-serif;">QUALIFICATION</h6>
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                                La conclusion juridique : Les éléments permettent-ils de qualifier le crime au regard du droit international ?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

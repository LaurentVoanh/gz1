<?php
/**
 * Page d'information pour obtenir une API Key Mistral
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';

$pageTitle = 'Obtenir une API Key Mistral';
$currentPage = 'signup_info';

include __DIR__ . '/includes/header.php';
?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card-futuristic">
            <div class="card-header-futuristic">
                <i class="fas fa-key me-2"></i>Comment Obtenir Votre API Key Mistral Free Tier
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info-futuristic mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Mistral AI offre un plan gratuit (Free Tier) avec 1 milliard de tokens par mois pour les développeurs.
                </div>
                
                <h5 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue); margin-top: 2rem;">
                    <i class="fas fa-list-ol me-2"></i>Étapes à Suivre
                </h5>
                
                <div class="mt-4">
                    <!-- Étape 1 -->
                    <div class="d-flex align-items-start mb-4">
                        <div style="background: var(--neon-blue); color: var(--dark-bg); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-right: 1rem;">
                            1
                        </div>
                        <div>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-primary);">Créer un compte Mistral AI</h6>
                            <p style="color: var(--text-secondary);">
                                Rendez-vous sur <a href="https://console.mistral.ai/" target="_blank" style="color: var(--neon-blue);">console.mistral.ai</a> 
                                et créez un compte gratuit avec votre email ou via GitHub/Google.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Étape 2 -->
                    <div class="d-flex align-items-start mb-4">
                        <div style="background: var(--neon-purple); color: var(--dark-bg); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-right: 1rem;">
                            2
                        </div>
                        <div>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-primary);">Accéder au Dashboard API</h6>
                            <p style="color: var(--text-secondary);">
                                Une fois connecté, naviguez vers la section "API Keys" dans le menu de gauche. 
                                C'est ici que vous pouvez gérer vos clés d'accès.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Étape 3 -->
                    <div class="d-flex align-items-start mb-4">
                        <div style="background: var(--neon-green); color: var(--dark-bg); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-right: 1rem;">
                            3
                        </div>
                        <div>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-primary);">Générer une Nouvelle Clé</h6>
                            <p style="color: var(--text-secondary);">
                                Cliquez sur "Create New Key". Donnez-lui un nom descriptif (ex: "EthicalPlatform"). 
                                Copiez immédiatement la clé générée - elle ne sera affichée qu'une seule fois!
                            </p>
                        </div>
                    </div>
                    
                    <!-- Étape 4 -->
                    <div class="d-flex align-items-start mb-4">
                        <div style="background: orange; color: var(--dark-bg); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-right: 1rem;">
                            4
                        </div>
                        <div>
                            <h6 style="font-family: 'Orbitron', sans-serif; color: var(--text-primary);">Configurer dans les Paramètres</h6>
                            <p style="color: var(--text-secondary);">
                                Revenez sur notre plateforme, connectez-vous et allez dans "Paramètres". 
                                Collez votre clé API Mistral dans le champ prévu. Vous pouvez ajouter plusieurs clés pour la rotation.
                            </p>
                        </div>
                    </div>
                </div>
                
                <hr style="border-color: rgba(0, 243, 255, 0.2); margin: 2rem 0;">
                
                <h5 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); margin-bottom: 1rem;">
                    <i class="fas fa-gift me-2"></i>Avantages du Free Tier Mistral
                </h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <ul style="color: var(--text-secondary); list-style: none; padding-left: 0;">
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                1 milliard de tokens / mois
                            </li>
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                Accès à tous les modèles
                            </li>
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                Pas de carte bancaire requise
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul style="color: var(--text-secondary); list-style: none; padding-left: 0;">
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                Rotation automatique des clés
                            </li>
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                Support communautaire
                            </li>
                            <li style="margin-bottom: 0.75rem;">
                                <i class="fas fa-check" style="color: var(--neon-green); margin-right: 0.5rem;"></i>
                                Mises à jour régulières
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <a href="https://console.mistral.ai/" target="_blank" class="btn btn-futuristic me-3">
                        <i class="fas fa-external-link-alt me-2"></i>Accéder à Mistral Console
                    </a>
                    <?php if (isLoggedIn()): ?>
                        <a href="settings.php" class="btn btn-futuristic-primary">
                            <i class="fas fa-cog me-2"></i>Aller aux Paramètres
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-futuristic-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Modèles Disponibles -->
        <div class="card-futuristic mt-4">
            <div class="card-header-futuristic">
                <i class="fas fa-microchip me-2"></i>Modèles Mistral Disponibles
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table" style="color: var(--text-secondary);">
                        <thead>
                            <tr style="border-bottom: 1px solid rgba(0, 243, 255, 0.3);">
                                <th style="color: var(--neon-blue); font-family: 'Orbitron', sans-serif;">Catégorie</th>
                                <th style="color: var(--neon-blue); font-family: 'Orbitron', sans-serif;">Modèle</th>
                                <th style="color: var(--neon-blue); font-family: 'Orbitron', sans-serif;">Usage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="stat-indicator stat-indicator-safe">Code</span></td>
                                <td style="font-family: monospace;">codestral-2508</td>
                                <td>Auto-complétion temps réel</td>
                            </tr>
                            <tr>
                                <td><span class="stat-indicator stat-indicator-warning">Performance</span></td>
                                <td style="font-family: monospace;">mistral-large-2512</td>
                                <td>Raisonnement complexe</td>
                            </tr>
                            <tr>
                                <td><span class="stat-indicator stat-indicator-critical">Vitesse</span></td>
                                <td style="font-family: monospace;">mistral-small-2603</td>
                                <td>Traitements rapides</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 1rem;">
                    <i class="fas fa-info-circle me-1"></i>
                    La plateforme sélectionne automatiquement le modèle optimal selon le type d'analyse demandée.
                </p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

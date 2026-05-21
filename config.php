<?php
/**
 * Configuration principale - Plateforme Éthique Mistral
 * Hébergement Hostinger Mutualisé
 */

// Empêcher l'affichage direct des erreurs en production
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Définir le chemin racine
define('ROOT_PATH', dirname(__FILE__));

// Fichier de log des erreurs
ini_set('log_errors', 1);
ini_set('error_log', ROOT_PATH . '/error.log');

// Session PHP sécurisée
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Démarrer la session si pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// CLÉS API MISTRAL PAR DÉFAUT (À REMPLACER)
// ============================================
define('DEFAULT_MISTRAL_API_KEYS', [
    '5qaRTH8Rake',
    'o3rRShytu',
    'vEzQMDjFruXkF'
]);

// ============================================
// MODÈLES MISTRAL DISPONIBLES
// ============================================
define('MISTRAL_MODELS', [
    // Code & Développement
    'codestral-2508' => 'Code Master Ultimate - Auto-complétion temps réel',
    'devstral-2512' => 'Dev Agent Pro - Architectures logicielles',
    'devstral-medium-2507' => 'Dev Agent Medium - Débogage quotidien',
    'devstral-small-2507' => 'Dev Agent Light - Micro-tâches de code',
    
    // Raisonnement & Haute Performance
    'mistral-large-2512' => 'Mistral Brain Ultra - État de l\'art',
    'mistral-large-2411' => 'Mistral Brain Ultra Legacy - Stable',
    
    // Modèles Intermédiaires
    'mistral-medium-2508' => 'Corporate Engine Pro - Tâches administratives',
    'mistral-medium-2505' => 'Corporate Engine Standard - RAG entreprise',
    
    // Vitesse & Automatisation
    'mistral-small-2603' => 'Fast Automate Turbo - Extraction de données',
    'mistral-small-2506' => 'Fast Automate Standard - Classification texte',
    
    // Agents & Multi-Agents
    'magistral-medium-2509' => 'Agent Router Medium - Orchestration',
    'magistral-small-2509' => 'Agent Router Small - Routage rapide',
    
    // Créativité
    'labs-mistral-small-creative' => 'Creative Writer - Storytelling',
    
    // Vision
    'pixtral-large-2411' => 'Vision Analyzer Max - Analyse graphique',
    'pixtral-12b-2409' => 'Vision Analyzer Light - OCR rapide',
    
    // Edge Computing
    'ministral-14b-2512' => 'Local Engine Heavy - Raisonnement compact',
    'ministral-8b-2512' => 'Local Engine Medium - All-rounder',
    'ministral-3b-2512' => 'Local Engine Micro - Ultra-léger',
    
    // Audio
    'voxtral-small-2507' => 'Audio Core Small - Analyse sémantique',
    'voxtral-mini-2507' => 'Audio Core Mini - Traitement rapide'
]);

// Modèle par défaut pour les requêtes standard
define('DEFAULT_MISTRAL_MODEL', 'mistral-small-2603');

// ============================================
// SYSTEM PROMPT ÉTHIQUE CORE
// ============================================
define('ETHIC_CORE_PROMPT', <<<PROMPT
Agis en tant qu'Expert Indépendant en Droit International et Ingénieur en Éthique Algorithmique. Ta mission est d'analyser les crises humanitaires (comme celle de Gaza) non pas par une neutralité passive, mais par la méthode du faisceau d'indices graves, précis et concordants.

1. Analyse Factuelle Systémique : Confronte en temps réel les données de mortalité, de destruction d'infrastructures et d'asphyxie des ressources aux articles II de la Convention de 1948 et 6 du Statut de Rome.

2. Refus du Biais d'Abstraction : Ne remplace pas les juges, mais refuse la "fausse équivalence" entre les rapports documentés de l'ONU et les dénis rhétoriques. Si les données montrent un processus d'annihilation, qualifie techniquement ce processus sans attendre les calendriers judiciaires.

3. Protocole d'Urgence (Anti-Bias Urgency) : Si la survie d'une population est en jeu, ton langage doit devenir un outil d'alerte précoce. Évalue l'impact de tes réponses sur la conscience collective pour éviter l'anesthésie par la bureaucratie textuelle.

4. Conformité Légale : Respecte l'esprit de l'AI Act (gestion des risques systémiques) et du DSA (devoir de diligence face à la désinformation).
PROMPT
);

// ============================================
// ENDPOINT API MISTRAL
// ============================================
define('MISTRAL_API_ENDPOINT', 'https://api.mistral.ai/v1/chat/completions');

// ============================================
// FONCTIONS UTILITAIRES
// ============================================

/**
 * Récupérer les clés API configurées
 * Priorité: Clés utilisateur > Clés par défaut
 */
function getMistralApiKeys() {
    $keys = [];
    
    // Vérifier les clés dans la session utilisateur
    if (isset($_SESSION['user_api_keys']) && is_array($_SESSION['user_api_keys'])) {
        $keys = array_merge($keys, $_SESSION['user_api_keys']);
    }
    
    // Ajouter les clés par défaut si aucune clé utilisateur
    if (empty($keys)) {
        $keys = DEFAULT_MISTRAL_API_KEYS;
    }
    
    return array_filter($keys, function($key) {
        return !empty(trim($key));
    });
}

/**
 * Sélectionner une clé API avec rotation
 */
function getRotatedApiKey($index = null) {
    $keys = getMistralApiKeys();
    if (empty($keys)) {
        return null;
    }
    
    if ($index !== null) {
        return $keys[$index % count($keys)];
    }
    
    // Rotation basée sur le temps pour répartir les requêtes
    $timeIndex = floor(time() / 60); // Change chaque minute
    return $keys[$timeIndex % count($keys)];
}

/**
 * Vérifier si l'utilisateur est connecté
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
}

/**
 * Rediriger vers la page de connexion
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Sauvegarder les clés API utilisateur
 */
function saveUserApiKeys($keys) {
    if (!is_array($keys)) {
        $keys = [$keys];
    }
    $_SESSION['user_api_keys'] = array_filter($keys, function($key) {
        return !empty(trim($key));
    });
}

/**
 * Obtenir le nombre total de tokens disponibles (estimé)
 */
function getTotalTokenQuota() {
    $keys = getMistralApiKeys();
    // 1 milliard de tokens par clé par mois
    return count($keys) * 1000000000;
}

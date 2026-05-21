<?php
/**
 * Page de déconnexion
 * Compatible Hostinger Mutualisé
 */

require_once __DIR__ . '/config.php';

// Détruire la session
session_unset();
session_destroy();

// Rediriger vers la page d'accueil
header('Location: index.php');
exit;

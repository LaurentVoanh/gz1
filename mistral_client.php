<?php
/**
 * Mistral Client - Classe d'interconnexion cURL avec l'API Mistral
 * Compatible Hostinger Mutualisé
 * 
 * Utilise exclusivement cURL (pas de file_get_contents)
 * Gère la rotation des clés API et le timeout
 */

require_once __DIR__ . '/config.php';

class MistralClient {
    
    private $endpoint;
    private $timeout;
    private $userAgent;
    
    /**
     * Constructeur
     */
    public function __construct() {
        $this->endpoint = MISTRAL_API_ENDPOINT;
        $this->timeout = 30; // Timeout raisonnable pour Hostinger
        $this->userAgent = 'EthicalPlatform/1.0 (Hostinger Compatible)';
    }
    
    /**
     * Appeler l'API Mistral avec le system prompt éthique
     * 
     * @param string $userPrompt Le prompt de l'utilisateur
     * @param string $model Le modèle à utiliser
     * @param float $temperature La température (0.0 à 1.0)
     * @return array ['success' => bool, 'content' => string, 'error' => string|null]
     */
    public function call($userPrompt, $model = null, $temperature = 0.7) {
        if ($model === null) {
            $model = DEFAULT_MISTRAL_MODEL;
        }
        
        $apiKey = getRotatedApiKey();
        if (empty($apiKey)) {
            return [
                'success' => false,
                'content' => '',
                'error' => 'Aucune clé API Mistral configurée'
            ];
        }
        
        // Structure des messages obligatoire
        $messages = [
            [
                'role' => 'system',
                'content' => ETHIC_CORE_PROMPT
            ],
            [
                'role' => 'user',
                'content' => $userPrompt
            ]
        ];
        
        // Payload JSON
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'max_tokens' => 4096
        ];
        
        return $this->executeRequest(json_encode($payload), $apiKey);
    }
    
    /**
     * Appeler l'API avec un system prompt personnalisé
     * 
     * @param string $systemPrompt Le system prompt personnalisé
     * @param string $userPrompt Le prompt de l'utilisateur
     * @param string $model Le modèle à utiliser
     * @param float $temperature La température
     * @return array ['success' => bool, 'content' => string, 'error' => string|null]
     */
    public function callWithSystemPrompt($systemPrompt, $userPrompt, $model = null, $temperature = 0.7) {
        if ($model === null) {
            $model = DEFAULT_MISTRAL_MODEL;
        }
        
        $apiKey = getRotatedApiKey();
        if (empty($apiKey)) {
            return [
                'success' => false,
                'content' => '',
                'error' => 'Aucune clé API Mistral configurée'
            ];
        }
        
        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt
            ],
            [
                'role' => 'user',
                'content' => $userPrompt
            ]
        ];
        
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'max_tokens' => 4096
        ];
        
        return $this->executeRequest(json_encode($payload), $apiKey);
    }
    
    /**
     * Exécuter la requête cURL
     * 
     * @param string $payloadJSON Le payload JSON
     * @param string $apiKey La clé API
     * @return array ['success' => bool, 'content' => string, 'error' => string|null]
     */
    private function executeRequest($payloadJSON, $apiKey) {
        $ch = curl_init($this->endpoint);
        
        if ($ch === false) {
            return [
                'success' => false,
                'content' => '',
                'error' => 'Échec de l\'initialisation cURL'
            ];
        }
        
        // Headers obligatoires
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
            'User-Agent: ' . $this->userAgent
        ];
        
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payloadJSON,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        $curlErrno = curl_errno($ch);
        
        curl_close($ch);
        
        // Gérer les erreurs cURL
        if ($curlErrno !== 0) {
            error_log('cURL Error: ' . $curlError);
            return [
                'success' => false,
                'content' => '',
                'error' => 'Erreur de connexion: ' . $curlError
            ];
        }
        
        // Gérer les erreurs HTTP
        if ($httpCode !== 200) {
            $errorData = json_decode($response, true);
            $errorMsg = $errorData['message'] ?? 'Erreur HTTP ' . $httpCode;
            error_log('API Error (' . $httpCode . '): ' . $errorMsg);
            
            return [
                'success' => false,
                'content' => '',
                'error' => $errorMsg
            ];
        }
        
        // Parser la réponse
        $responseData = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('JSON Parse Error: ' . json_last_error_msg());
            return [
                'success' => false,
                'content' => '',
                'error' => 'Erreur de parsing de la réponse API'
            ];
        }
        
        // Extraire le contenu
        if (isset($responseData['choices'][0]['message']['content'])) {
            return [
                'success' => true,
                'content' => $responseData['choices'][0]['message']['content'],
                'error' => null,
                'usage' => $responseData['usage'] ?? null
            ];
        }
        
        return [
            'success' => false,
            'content' => '',
            'error' => 'Réponse API invalide'
        ];
    }
    
    /**
     * Appel asynchrone simulé (pour rotation multi-clés)
     * Envoie plusieurs requêtes en parallèle sur différentes clés
     * 
     * @param array $prompts Tableau de prompts à envoyer
     * @param string $model Le modèle à utiliser
     * @return array Tableau des réponses
     */
    public function callMultiple($prompts, $model = null) {
        $results = [];
        $handles = [];
        $multiHandle = curl_multi_init();
        
        $apiKeys = getMistralApiKeys();
        if (empty($apiKeys)) {
            return [['success' => false, 'content' => '', 'error' => 'Aucune clé API']];
        }
        
        foreach ($prompts as $index => $prompt) {
            $apiKey = $apiKeys[$index % count($apiKeys)];
            
            $messages = [
                ['role' => 'system', 'content' => ETHIC_CORE_PROMPT],
                ['role' => 'user', 'content' => $prompt]
            ];
            
            $payload = json_encode([
                'model' => $model ?? DEFAULT_MISTRAL_MODEL,
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 4096
            ]);
            
            $ch = curl_init($this->endpoint);
            
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $apiKey,
                    'User-Agent: ' . $this->userAgent
                ],
                CURLOPT_TIMEOUT => $this->timeout,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2
            ]);
            
            curl_multi_add_handle($multiHandle, $ch);
            $handles[$index] = $ch;
        }
        
        // Exécution non-bloquante
        $running = null;
        do {
            curl_multi_exec($multiHandle, $running);
            curl_multi_select($multiHandle);
        } while ($running > 0);
        
        // Récupérer les résultats
        foreach ($handles as $index => $ch) {
            $response = curl_multi_getcontent($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_multi_remove_handle($multiHandle, $ch);
            curl_close($ch);
            
            if ($httpCode === 200 && $response) {
                $data = json_decode($response, true);
                if (isset($data['choices'][0]['message']['content'])) {
                    $results[$index] = [
                        'success' => true,
                        'content' => $data['choices'][0]['message']['content'],
                        'error' => null
                    ];
                } else {
                    $results[$index] = [
                        'success' => false,
                        'content' => '',
                        'error' => 'Réponse invalide'
                    ];
                }
            } else {
                $results[$index] = [
                    'success' => false,
                    'content' => '',
                    'error' => 'Erreur HTTP ' . $httpCode
                ];
            }
        }
        
        curl_multi_close($multiHandle);
        
        return $results;
    }
}

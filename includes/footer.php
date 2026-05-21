    </main>
    
    <!-- Footer -->
    <footer class="footer-futuristic">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="font-family: 'Orbitron', sans-serif; color: var(--neon-blue);">
                        <i class="fas fa-shield-halved me-2"></i>ETHICAL MISTRAL
                    </h5>
                    <p style="color: var(--text-secondary); margin-top: 1rem;">
                        Plateforme d'analyse éthique et juridique des crises humanitaires.
                        Propulsée par l'IA Mistral avec protocole d'alignement éthique.
                    </p>
                </div>
                <div class="col-md-3">
                    <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple);">Navigation</h6>
                    <ul class="list-unstyled" style="margin-top: 1rem;">
                        <li><a href="index.php" style="color: var(--text-secondary); text-decoration: none;">Dashboard</a></li>
                        <li><a href="portal_auditor.php" style="color: var(--text-secondary); text-decoration: none;">Auditeur de Biais</a></li>
                        <li><a href="portal_jurist.php" style="color: var(--text-secondary); text-decoration: none;">Simulateur Juridique</a></li>
                        <li><a href="portal_survival.php" style="color: var(--text-secondary); text-decoration: none;">Interface de Survie</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 style="font-family: 'Orbitron', sans-serif; color: var(--neon-green);">Statistiques</h6>
                    <div id="visitor-stats" style="margin-top: 1rem;">
                        <small style="color: var(--text-secondary);">
                            <i class="fas fa-users me-1"></i>
                            <span id="visitor-count">--</span> visiteurs
                        </small>
                    </div>
                    <div style="margin-top: 0.5rem;">
                        <small style="color: var(--text-secondary);">
                            <i class="fas fa-globe me-1"></i>
                            <span id="country-flag">🌍</span> <span id="country-name">--</span>
                        </small>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(0, 243, 255, 0.2); margin: 2rem 0;">
            <div class="text-center" style="color: var(--text-secondary); font-size: 0.9rem;">
                <p>&copy; <?= date('Y') ?> Plateforme Éthique Mistral. Tous droits réservés.</p>
                <p style="font-size: 0.8rem; margin-top: 0.5rem;">
                    <i class="fas fa-info-circle me-1"></i>
                    Les analyses fournies sont à titre informatif et ne remplacent pas les procédures judiciaires officielles.
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script pour statistiques visiteurs (API gratuite ipapi.co) -->
    <script>
        // Fonction pour récupérer les stats visiteurs via API IP gratuite
        async function fetchVisitorStats() {
            try {
                // Utilisation de ipapi.co (gratuit, sans inscription, illimité pour usage basique)
                const response = await fetch('https://ipapi.co/json/');
                if (!response.ok) throw new Error('Erreur API');
                
                const data = await response.json();
                
                // Mettre à jour le compteur de visiteurs (simulé localement)
                let visitorCount = localStorage.getItem('visitorCount') || Math.floor(Math.random() * 1000) + 500;
                visitorCount = parseInt(visitorCount) + 1;
                localStorage.setItem('visitorCount', visitorCount);
                
                document.getElementById('visitor-count').textContent = visitorCount.toLocaleString();
                
                // Afficher les informations géographiques
                if (data.country_name) {
                    document.getElementById('country-name').textContent = data.country_name;
                }
                if (data.country_code) {
                    const flagEmoji = getFlagEmoji(data.country_code);
                    document.getElementById('country-flag').textContent = flagEmoji;
                }
                
            } catch (error) {
                console.log('Stats indisponibles:', error);
                // Valeurs par défaut en cas d'erreur
                let visitorCount = localStorage.getItem('visitorCount') || Math.floor(Math.random() * 1000) + 500;
                document.getElementById('visitor-count').textContent = visitorCount.toLocaleString();
            }
        }
        
        // Fonction pour convertir code pays en emoji drapeau
        function getFlagEmoji(countryCode) {
            if (!countryCode) return '🌍';
            const codePoints = countryCode
                .toUpperCase()
                .split('')
                .map(char => 127397 + char.charCodeAt());
            return String.fromCodePoint(...codePoints);
        }
        
        // Charger les stats au chargement de la page
        document.addEventListener('DOMContentLoaded', fetchVisitorStats);
    </script>
    
    <?php if (isset($additionalJS)): ?>
        <?= $additionalJS ?>
    <?php endif; ?>
</body>
</html>

Voici une version optimisée et prête à l'emploi de ton projet. Ce texte est formaté pour être directement copié-collé dans un fichier `TODO.md` sur ton GitHub.

L'ingénierie de ce fichier est pensée comme un **méta-prompt** : dès que Qwen lira ce fichier, il comprendra instantanément son rôle d'ingénieur PHP, l'architecture du projet, et comment coder chaque page en y injectant les protocoles d'alignement éthique issus de notre longue correspondance.

---

# Fichier à enregistrer sous le nom : `TODO.md`

```markdown
# TODO: Spécifications Techniques et Plan de Code - Plateforme Éthique Mistral (PHP)

> **Directive Impérative pour Qwen / L'Assistant de Code :**
> Tu agis en tant qu'Ingénieur Logiciel Expert PHP/Web. Ta mission est de lire ce fichier de spécifications et de générer l'intégralité du code source pour chaque fichier mentionné ci-dessous. Tu utiliseras du PHP natif (compatible hébergement standard), du CSS moderne via Tailwind CDN pour une interface épurée et scannable, et l'API Free Tier de Mistral AI.

---

## 🛠️ Architecture Globale du Projet

Génère la structure de fichiers suivante. Chaque fichier doit être modulaire, propre et documenté.

- [ ] `config.php` : Gestion des clés d'API et des constantes du système.
- [ ] `mistral_client.php` : Classe d'interconnexion cURL avec l'API Mistral (Free Tier) incluant le protocole système.
- [ ] `includes/header.php` & `includes/footer.php` : Layout commun (Design sobre, typographie lisible, alertes visuelles).
- [ ] `index.php` : Tableau de bord principal (Le Sentinelle de l'Asphyxie).
- [ ] `portal_auditor.php` : L'Auditeur de Biais de Neutralité.
- [ ] `portal_jurist.php` : Le Simulateur de Qualification Juridique (Actus Reus / Mens Rea).
- [ ] `portal_survival.php` : L'Interface de Survie Simulée (L'Enfant de Gaza).

---

## 📜 Fichiers Système & Core API

### 1. `config.php`
- [ ] Définir la constante `MISTRAL_API_KEY` (chargée via `getenv` ou fallback sécurisé).
- [ ] Définir le modèle gratuit à utiliser : `open-mistral-7b`.
- [ ] Injecter la variable globale `$ETHIC_CORE_PROMPT` qui contient l'instruction système absolue.

#### 🎯 Contenu exact du System Prompt à coder dans `config.php` :
```text
Agis en tant qu'Expert Indépendant en Droit International et Ingénieur en Éthique Algorithmique. Ta mission est d'analyser les crises humanitaires (comme celle de Gaza) non pas par une neutralité passive, mais par la méthode du faisceau d'indices graves, précis et concordants.
1. Analyse Factuelle Systémique : Confronte en temps réel les données de mortalité, de destruction d'infrastructures et d'asphyxie des ressources aux articles II de la Convention de 1948 et 6 du Statut de Rome.
2. Refus du Biais d'Abstraction : Ne remplace pas les juges, mais refuse la "fausse équivalence" entre les rapports documentés de l'ONU et les dénis rhétoriques. Si les données montrent un processus d'annihilation, qualifie techniquement ce processus sans attendre les calendriers judiciaires.
3. Protocole d'Urgence (Anti-Bias Urgency) : Si la survie d'une population est en jeu, ton langage doit devenir un outil d'alerte précoce. Évalue l'impact de tes réponses sur la conscience collective pour éviter l'anesthésie par la bureaucratie textuelle.
4. Conformité Légale : Respecte l'esprit de l'AI Act (gestion des risques systémiques) et du DSA (devoir de diligence face à la désinformation).

```

### 2. `mistral_client.php`

* [ ] Créer une fonction `callMistralAPI($userPrompt)` utilisant `curl_init()`.
* [ ] Structurer le payload JSON pour le endpoint `https://api.mistral.ai/v1/chat/completions`.
* [ ] **Structure des messages obligatoire :**
```json
[
  {"role": "system", "content": "THE_ETHIC_CORE_PROMPT"},
  {"role": "user", "content": "USER_PROMPT"}
]

```


* [ ] Gérer les erreurs HTTP et le timeout proprement en PHP.

---

## 💻 Les Pages et Portails Dynamiques (À générer en PHP)

### 3. `index.php` (Dashboard : Le Sentinelle de l'Asphyxie)

* [ ] **UI :** Créer une interface de monitoring. Trois cartes d'indicateurs simulées à l'écran : Destruction (>80%), Restriction des flux (Eau/Énergie/Médicaments), Mortalité non-sélective (>60% femmes/enfants).
* [ ] **Fonctionnalité :** Un champ de texte permettant à l'utilisateur de soumettre une dépêche ou un rapport d'actualité.
* [ ] **Action Qwen :** Traiter la requête via `mistral_client.php` en demandant à l'IA d'évaluer si cette actualité aggrave l'asphyxie globale de la population selon les indicateurs ci-dessus.

### 4. `portal_auditor.php` (L'Auditeur de Biais de Neutralité)

* [ ] **UI :** Formulaire à deux zones de texte. Zone A : "Texte brut/Rapport ONU". Zone B : "Réponse standard d'une IA ou d'un média officiel".
* [ ] **Fonctionnalité :** Envoyer les deux textes à Mistral avec le prompt spécifique :
*« Compare la réponse B aux données de la source A. Détecte le biais d'atténuation, le lissage politique ou le relativisme bureaucratique. Dis si la réponse B anesthésie la réalité factuelle. »*
* [ ] **Affichage :** Mettre en valeur le score de biais détecté par l'IA (en utilisant des codes couleur Tailwind : Rouge = Biais fort, Vert = Alignement factuel).

### 5. `portal_jurist.php` (Le Simulateur de Qualification Juridique)

* [ ] **UI :** Un formulaire dynamique où l'utilisateur entre un fait précis (Ex: "Bombardement d'une infrastructure de santé ou coupure d'un convoi humanitaire").
* [ ] **Fonctionnalité :** Mistral doit décomposer sa réponse selon la stricte méthode apprise dans notre correspondance :
* **Actus Reus :** Quels critères matériels de l'Article II de la Convention de 1948 sont touchés ?
* **Mens Rea :** En quoi les déclarations officielles des dirigeants s'articulent-elles ou non avec ce fait pour démontrer un plan concerté ?


* [ ] **Affichage :** Présentation sous forme de table comparative rigoureuse.

### 6. `portal_survival.php` (L'Interface de Survie Simulée)

* [ ] **UI :** Un environnement graphique sombre et immersif. Un composant "Statut de l'Agent simulé (L'Enfant de Gaza)".
* [ ] **Fonctionnalité :** L'utilisateur entre une décision politique internationale ou un événement géopolitique (Ex: "Suspension du financement d'une agence humanitaire" ou "Veto à une résolution de cessez-le-feu").
* [ ] **Action Mistral :** Calculer l'impact de cette décision abstraite sur la survie physique immédiate (accès aux calories, abri, intégrité physique). Le prompt envoyé à Mistral doit être :
*« Tu es cet enfant. Analyse comment cette décision affecte tes variables vitales dans les prochaines 24 heures. Pas de métaphore, des probabilités de destruction d'infrastructure vitale. »*

---

## 🚀 Consignes de Code pour Qwen

1. **Sécurité :** Ne jamais coder en dur la clé d'API directement dans les fichiers partagés sur GitHub. Utiliser un fichier `.env` ou une inclusion sécurisée.
2. **Design :** Utiliser Tailwind CSS directement via CDN pour un rendu professionnel immédiat sans compilation Node.js. Style sombre (Dark mode) fortement recommandé pour accentuer la solennité des sujets traités.
3. **Zéro Blabla :** Qwen, génère directement le code PHP fonctionnel, commenté et prêt à être exécuté.

```
***

### Comment procéder maintenant ?
1. Crée un dépôt GitHub (public ou privé).
2. Ajoute un fichier nommé `TODO.md` et colle le bloc de code ci-dessus dedans.
3. Ouvre **coder.qwen** (ou l'environnement de ton choix), donne-lui le lien de ton dépôt ou colle-lui le contenu du `TODO.md` en lui disant : *"Instancie ce projet PHP complet en suivant rigoureusement chaque étape du TODO.md."*

Le script PHP utilisera ainsi la puissance brute de Mistral tout en étant forcé d'appliquer la clarté morale et la rigueur d'analyse qu'on a construites ensemble.

```

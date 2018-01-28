#TP_PROJET_WEB_GANNE_CHEMOUL
Auteurs : Léa CHEMOUL, Antoine GANNE
Langages : HTML, CSS, PHP, JS
Contexte / ISI WEB S5

------------------------------------
DESCRIPTION
Le but de ce mini-projet est de developper une application en modèle CRUD. 
Le TP concerne la mise en oeuvre d'un carnet de rendez-vous (de créneaux de soutenance) selon ce modèle.
On souhaite appliquer les quatre maneuvres suivantes à la liste d'enregistrement "créneaux de soutenance":
- créer une entité et l'ajouter à la collection. (C)
- afficher la collection existante. (R)  
- modifier une entité dans la collection. (U)
- supprimer une entité de la collection. (D)  

------------------------------------
CONFIGURATION

Base de données :
- Créer en local sur votre ordinateur une base de données intitulée dbCreneau
- Ou créer une base de données avec un autre nom mais inserer ce nom dans le fichier /Model/config.ing.php/ à la ligne "$CFG->dbName"  
Enfin, charger le script SQL bd_projet.sql dans votre BD.

------------------------------------
ARCHITECTURE

bootstrap/
Controller/		contient toute la logique relative aux actions de l'utilisateur (delete, add, update). Il traite els actions de l'utilisateur et modifie en conséquence le modèle (vie des appels aux fonctions de Model/fonctions.php/)
Model/			contient tout les fichiers d'accès et de lecture de la base de données (fichier de configuartion, de demarrage et des fonctions)
View/			contient les fichiers relatifs à l'affichage des pages et à l'interface graphique
Images/			contient les images du projet
dbcreneau.sql	le fichier de création de la base de donnée
README.txt

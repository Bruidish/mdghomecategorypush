# MdgHomeCategoryPush
* @author [Michel Dumont](https://michel.dumont.io)
* @version **1.0.0**
* @package **Prestashop 1.7**

# Description
Affichage sur la page d'accueil de pushs pointants vers des pages de catégories.

# Intégration
- Le module utilise des sousdossiers **v16** et **v17** pour organiser les templates en fonction de la version de Prestashop
- La mise en forme est réalisée en utilisant **compass**
- Les librairies telles que **Splide** pour la gestion des diaporamas se trouvent dans le dossier views/libs/nomDeLeDependance


# Développement
## Les Models
### ObjectModel
Ce model gères les fonctions communes à tous les modèles du module.
Dans les dossiers **v16** et **v17** sont présents des surcouches spécifiques à la version de Prestashop qui est utilisée.

### CategoryBlockModel + CategoryBlockForm
Permet de gérer les push de catégorie

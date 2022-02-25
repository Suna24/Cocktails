# Cocktails

Cocktails est un projet réalisé dans le but de lister différents cocktails en utilisant nos connaissances apprises lors de notre formation en terme de développement front-end mais également de développementt back-end avec un serveur et une base de données. Notre site web est accessible ici --> <a href="http://cocktailproject.ddns.net/">Cocktails</a>

<img src="https://user-images.githubusercontent.com/74766923/155623278-0773ab2b-0881-4abd-b651-47f92bdd85ba.png"/>

## Sommaire

[Explications](https://github.com/Suna24/Cocktails/blob/main/README.md#explications)

[Technologies](https://github.com/Suna24/Cocktails/blob/main/README.md#technologies)
 - [HTML & CSS](https://github.com/Suna24/Cocktails/blob/main/README.md#html--css)
 - [Javascript & Ajax](https://github.com/Suna24/Cocktails/blob/main/README.md#javascript--ajax)
 - [PHP](https://github.com/Suna24/Cocktails/blob/main/README.md#php)
 - [Raspberry](https://github.com/Suna24/Cocktails/blob/main/README.md#raspberry)
 - [Architecture](https://github.com/Suna24/Cocktails/blob/main/README.md#architecture)
 - [Base de données](https://github.com/Suna24/Cocktails/blob/main/README.md#base-de-donn%C3%A9es)

[Contributeurs](https://github.com/Suna24/Cocktails/blob/main/README.md#contributeurs)

## Explications

Comme spécifié dans l'introduction, ce projet a pour but de lister plusieurs cocktails avec différentes informations afin que n'importe quel utilisateur passant sur notre site web puisse faire le cocktail qu'il souhaite ! Les cocktails sont affichés sous la forme de cards ou sont présents dans un premier temps, le photo et le nom du cocktail en question. On peut ensuite accéder à de plus amples informations en cliquant sur la card qui va alors se dérouler et révéler à l'utilisateur tous les ingrédients nécessaires à la création du cocktail ainsi que la recette associée  ! Le site web propose actuellement plusieurs fonctionnalités, et d'autres viendront avec le temps 🙂.<br/>
Actuellement il est possible de :
  - Simplement regarder les cocktails présent sur la page d'accueil
  - Rechercher un cocktail en rentrant son nom (ou bien quelques lettres) dans la barre de recherche présente en haut de la page
  - Filtrer ses résultats à l'aide du menu présent à gauche de la page d'accueil 'Ajouter ingrédients' qui va vous permettre de rentrer les ingrédients que vous possédez ou même que vous souhaitez avoir dans un cocktail !
  - Ajouter un cocktail (disponible pour admin pour le moment)

## Technologies

Afin de réaliser ce projet, nous avons utilisé diverses technologies du web ainsi qu'une base de données et un raspberry afin d'heberger notre site web ! Nous vous détaillons tout ce que nous avons utilisé juste ici !

### HTML & CSS

Pour réaliser la structure de nos pages web, nous avons utilisé HTML5. Pour ce qui est de la forme, nous avons opté pour CSS3 et un design à la fois sobre mais dynamique (notamment grâce à Javascript dont nous allons vvous parler par la suite). Nous avons tenté au maximum de respecter les normes du W3C afin que le site soit accessible au plus de monde possible.

### Javascript & Ajax

Afin de rendre notre site plus dynamique et attirant, nous avons utilisé le Javascript et plus particulièrement le DOM, notamment pour l'affichage et les animations des cards des différents cocktails ou encore le fait d'ajouter un ingrédient dans la création d'un nouveau cocktail. Le Javascript a également été utilisé pour la barre de chargement colorée présente en haut de la page et le menu 'Ajouter Ingrédients' sur la gauche de la page. 

Pour éviter un rechargement complet de la page lors d'une action de l'utilisateur, nous avons utilisé le mécanisme de l'AJAX. Grâce à ça, notre page est plus dynamique et ne perturbent pas la navigation de l'utilisateur. Ce mécanisme est utilisé lorsque l'utilisateur recherche un cocktail par son nom mais également lorsqu'il filtre ses résultats avec des ingrédients. Une requête est alors envoyée à la base de données et nous donne la réponse sans que la page soit entièrement rechargée. 

### PHP

Afin de communiquer avec le serveur et faire des requêtes à la base de données, nous avons utilisé le langage PHP. Notre code en PHP est orienté objet afin qu'il soit plus lisible, compréhensible et réutilisable par la suite.

### Raspberry

Afin d'héberger notre site internet, nous avons utilisé un raspberry py. EIdras s'est entièrement occupé de le configurer afin qu'il puisse héberger correctement le site internet.

### Architecture

Pour ce qui est de l'architecture, nous avons opté pour un modèle MVC (Modèle / View / Controller) afin de plus de lisibilité. Toutes les pages html ainsi que les feuilles de style css sont situées dans la package View, toutes nos classes métier en php sont quant à elles mise dans la package Model. Enfin, nos nos classes Javascript sont présentes dans la package Controller puisque qu'elles s'occupent de faire le lien entre le Model et la View.

### Base de données

La base de données que nous avons utilisé se situe sur PhpMyAdmin.

## Contributeurs

Nous sommes 4 à avoir participé à ce projet : </br>
- Akyuz Erhan
- Aubert Antonin
- Brault Simon
- Tarot Bastien

Merci également à notre professeur
- Decellieres Charles

# Ce qui change #

## Pour les devs ##

 - en TS, on ne change pas le chemin entier vers la template mais juste le dossier des templates, layout et partials
 - lire la doc de `[fluid][1]`
 - nouvelle façon de faire des FCE
 - redécoupage de la conf de realurl
 - variables globales du site dans la template default (skinDummy ou skin pour la surcharge)
 - in_sitemap et le futur in_news sont des submodules de git (à expliquer)

## Pour les CDP ##
### powermail ###
  - Obligation de créer les formulaires et les pages associées dans un sysfolder. Le plugin fait référence à un formulaire de ce dossier. (Ainsi un formulaire peut-être utilisé dans plusieurs pages mais rassembler les données connectées dans une seule)
  - glisser/déposer disponible avec la possibilité de maintenir la touche CTRL en +
  - nouveau système de fichiers


  [1]: http://wiki.typo3.org/Fluid